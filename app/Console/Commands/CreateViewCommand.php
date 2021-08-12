<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;

class CreateViewCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:besource {besource}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new resource blade templates.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $model = $this->argument('besource');
        $resources = $this->getResource();
        $stubs = $this->getStub();
        $this->createRequests($model);
        $this->createController($model);
        $path = $this->createDir($model);

        # ========================================== #
        foreach($resources as $resource) {
            if (!File::exists($filepath = $path . $resource['file_name']) )
            {
                $content = File::get($stubs[$resource['name']]);
                File::put($filepath, $content);
            }
        }

        # ========================================== #
        $this->info("Resource for {$model} created.");
    }

    protected function getResource(): array
    {
        return [
            [
                'file_name' => 'index.blade.php',
                'name' => 'index'
            ],
            [
                'file_name' => 'create.blade.php',
                'name' => 'create'
            ],
            [
                'file_name' => 'edit.blade.php',
                'name' => 'edit'
            ],
            [
                'file_name' => 'show.blade.php',
                'name' => 'show'
            ],
            [
                'file_name' => '__table.blade.php',
                'name' => '__table'
            ],
            [
                'file_name' => '__form.blade.php',
                'name' => '__form'
            ]
        ];
    }

    protected function createDir($model)
    {

        $path = "resources\\views\\backend\\pages\\{$model}\\";

        if (is_dir($path)) {
            $this->error("Resource or directory already exists!");
        }
        
        # ========================================== #
        mkdir($path, 0777, true);
        return $path;
    }

    protected function createController($model)
    {
        if (str_contains($model, '\\')) {
            $mapped = array_map(fn($item) => ucfirst($item), explode('\\', $model));
            $model = implode('', $mapped);
        }

        $filename = ucfirst($model)."Controller.php";
        $path = "app\\Http\\Controllers\\Backend\\$filename";

        if (File::exists($path)) {
            $this->line("$filename is already exists!");
        }
        $content = File::get("app\\Console\\Stubs\\custom-controller.stub");
        File::put($path, $content);
    }

    protected function createRequests($model)
    {
        if (str_contains($model, '\\')) {
            $exploded = explode('\\', $model);
            $except_last = array_slice($exploded, 0, -1);
            $ucfirsted = array_map(fn($item) => ucfirst($item), $except_last);
            $dir_name = implode('\\', $ucfirsted);
            $model = end($exploded);
        }
        $dir_name = ucfirst($model) . '\\';
        $name = ucfirst($model);

        $requests = [
            [
                'filename' => "Create{$name}Request.php",
                'content' =>  "app\\Console\\Stubs\\create-request.stub"
            ],
            [
                'filename' => "Update{$name}Request.php",
                'content' => "app\\Console\\Stubs\\update-request.stub"
            ]
        ];

        $dir_path = "app\\Http\\Requests\\{$dir_name}";
        if (!File::exists($dir_path)) {
            File::makeDirectory($dir_path);
        }
        foreach($requests as $request) {
            if (!File::exists($dir_path . $request['filename'])) {
                $content = File::get($request['content']);
                File::put($dir_path . $request['filename'], $content);
            }
            $this->line("{$request['filename']} is already exists!");
        }
    }

    protected function getStub(): array
    {
        $dir = app_path('\\Console\\Stubs\\Resource\\');
        $scanned = scandir($dir);
        $stubs = array_diff($scanned, ['..', '.']);

        # ========================================== #
        return array_reduce($stubs, function($carry, $stub) use ($dir) {
            $carry[explode('.', $stub)[0]] = $dir . $stub;
            return $carry;
        }, []);
    }
}