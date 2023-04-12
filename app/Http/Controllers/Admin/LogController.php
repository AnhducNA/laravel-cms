<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewer;

class LogController extends Controller
{
    protected $request;
    /**
     * @var string
     */
    protected $view_log = 'laravel-log-viewer::log';
    /**
     * @var LaravelLogViewer
     */
    private $log_viewer;

    /**
     * LogViewerController constructor.
     */
    public function __construct()
    {
        $this->log_viewer = new LaravelLogViewer();
    }

    function index()
    {
        $data = [
            'files' => $this->log_viewer->getFiles(true)
        ];
        return view('admin.log.index', compact('data'));
//        dd($log_viewer->getFiles(true));
    }

    function preview($file)
    {
        $view_log = $this->view_log;
        $folderFiles = [];
        $this->log_viewer->setFile($file);

        $data = [
            'logs' => $this->log_viewer->all(),
            'folders' => $this->log_viewer->getFolders(),
            'current_folder' => $this->log_viewer->getFolderName(),
            'folder_files' => $folderFiles,
            'files' => $this->log_viewer->getFiles(true),
            'current_file' => $this->log_viewer->getFileName(),
            'standardFormat' => true,
            'structure' => $this->log_viewer->foldersAndFiles(),
            'storage_path' => $this->log_viewer->getStoragePath(),

        ];

        if (is_array($data['logs']) && count($data['logs']) > 0) {
            $firstLog = reset($data['logs']);
            if ($firstLog) {
                if (!$firstLog['context'] && !$firstLog['level']) {
                    $data['standardFormat'] = false;
                }
            }
        }
//        dd($data);
        $data['logs'] = $this->paginate($data['logs'], 10);
        return view('admin.log.log', compact('view_log', 'data'));
    }

    public static function paginate($items, $perPage = 5, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage;
        $itemstoshow = array_slice($items, $offset, $perPage);
//        dd($page);

        return new LengthAwarePaginator($itemstoshow, $total, $perPage);
    }

    function show($file)
    {
//        dump($file);
        $data = [
            'logs' => $this->log_viewer->all(),
        ];
$log = $this->log_viewer->all()[$file];
        return view('admin.log.show', compact('log'));
    }

}
