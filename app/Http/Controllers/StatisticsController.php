<?php

namespace App\Http\Controllers;

use App\Models\View;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\KategoriModel;
use App\Models\PengiklanModel;
use App\Models\BeritaModel;
use Illuminate\Http\Request; 
use Carbon\Carbon;



class StatisticsController extends Controller
{
    //view  grafilk berdasarkan waktu yang ditentukan
    public function viewsByPeriod()
    {
        $endDate = Carbon::today()->endOfWeek();
        $startDate = Carbon::today()->startOfWeek();

        // Initialize date array
        $dateArray = [];
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $dateArray[$date->format('j F')] = 0;
        }

        $views = View::whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw('Date(created_at) as date'), DB::raw('count(*) as views'))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        // Update date array with actual views
        foreach ($views as $view) {
            $dateArray[Carbon::parse($view->date)->format('j F')] = $view->views;
        }

        $dates = array_keys($dateArray);
        $counts = array_values($dateArray);

        return ['dates' => $dates, 'counts' => $counts];
    }

    //view top 5 author berdasarkan berita yang di publish
    public function topAuthors()
    {
        $authors = User::withCount('berita')
            ->where('role', 'author')
            ->orderBy('berita_count', 'desc')
            ->take(5)
            ->get();

        return $authors;
    }

    //view top 5 berita berdasarkan jumlah view
    public function topPosts()
    {
        $posts = BeritaModel::withCount('views')
            ->orderBy('views_count', 'desc')
            ->take(7)
            ->get();

        return $posts;
    }

    //view top 5 kategori berdasarkan jumlah view
    public function topCategories()
    {
        $categories = KategoriModel::select('kategori.nama_kategori', DB::raw('count(*) as view_count'))
            ->join('berita', 'berita.kategori_berita', '=', 'kategori.id_kategori')
            ->join('views', 'views.post_id', '=', 'berita.id_berita')
            ->groupBy('kategori.nama_kategori')
            ->orderBy('view_count', 'desc')
            ->take(5)
            ->get();

        $categories_names = $categories->pluck('nama_kategori')->toArray();
        $view_counts = $categories->pluck('view_count')->toArray();

        return ['categories_names' => $categories_names, 'view_counts' => $view_counts];
    }

    //view berita per kategori
    public function newsPerCategory()
    {
        $beritaPerKategori = KategoriModel::withCount('berita')
            ->orderBy('berita_count', 'desc')
            ->get();

        $kategoriLabels = $beritaPerKategori->pluck('nama_kategori');
        $beritaCounts = $beritaPerKategori->pluck('berita_count');

        return compact('kategoriLabels', 'beritaCounts');
    }

    //view statistik umum
    public function generalStatistics()
    {
        $totalVisitors = View::count();
        $totalBerita = BeritaModel::count();
        $totalAuthor = User::where('role', 'author')->count();

        return compact('totalVisitors','totalBerita','totalAuthor');
    }

    //view jumlah view berita
    public function views()
    {
        $today = Carbon::today()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();

        $viewsToday = View::where('created_at', '>=', $today)->where('created_at', '<=', $today . ' 23:59:59')->count();
        $viewsYesterday = View::where('created_at', '>=', $yesterday)->where('created_at', '<=', $yesterday . ' 23:59:59')->count();

        $changePercent = 0;
        if ($viewsYesterday != 0) {
            $changePercent = (($viewsToday - $viewsYesterday) / $viewsYesterday) * 100;
        }

        return ['viewsToday' => $viewsToday, 'viewsYesterday' => $viewsYesterday, 'changePercent' => $changePercent];
    }


   public function getChartData()
    {
        return $this->viewsByPeriod();
    }


    //view statistik
    public function showStatistics(Request $request)
    {
        $viewsData = $this->viewsByPeriod();
        $authors = $this->topAuthors();
        $posts = $this->topPosts();
        $categories = $this->topCategories();
        $newsPerCategoryData = $this->newsPerCategory();
        $generalStatisticsData = $this->generalStatistics();
        $views= $this->views();
        $monthlyIncome = $this->getMonthlyIncome($request);
        $data = array_merge($viewsData, ['authors' => $authors, 'posts' => $posts, 'categories' => $categories, 'monthlyIncome' => $monthlyIncome], $newsPerCategoryData, $generalStatisticsData, $views);

        return view('admin.statistik', $data);

    }
    
   public function getMonthlyIncome(Request $request)
    {
        $currentYear = $request->input('year', date('Y'));
        $monthlyIncomeData = PengiklanModel::getMonthlyIncomeByYear($currentYear);

        // Convert the collection to an associative array with the month as the key
        $monthlyIncomeArray = $monthlyIncomeData->mapWithKeys(function ($item) {
            return [$item['month'] => $item['income']];
        })->all();

        // Get the income for the current month and the previous month
        $currentMonth = date('n');
        $previousMonth = $currentMonth - 1;
        $incomeThisMonth = $monthlyIncomeArray[$currentMonth] ?? 0;
        $incomeLastMonth = $monthlyIncomeArray[$previousMonth] ?? 0;

        // Calculate the percentage change
        $changePercent = 0;
        if ($incomeLastMonth != 0) {
            $changePercent = (($incomeThisMonth - $incomeLastMonth) / $incomeLastMonth) * 100;
        }

        return [
            'currentMonth' => $incomeThisMonth,
            'previousMonth' => $incomeLastMonth, // Add data for the previous month
            'changePercent' => $changePercent,
        ];
    }



}
