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
        $requests = $this->createRequests($model);
        $this->createController($model, $requests);
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

    protected function createController($model, $requests)
    {
        $route = $model;
        $object = $model;
        if (str_contains($model, '\\')) {
            $mapped = array_map(fn($item) => ucfirst($item), explode('\\', $model));
            $route = str_replace('\\', '.', $model);
            $for_object = explode('.', $route);
            $object = end($for_object);
            $model = implode('', $mapped);
        }

        $filename = ucfirst($model);
        $path = "app\\Http\\Controllers\\Backend";

        $components = $this->getControllerComponents($filename, $path, $route, $object, $filename, $requests);
        $replacements = ['{{class}}', '{{namespace}}', '{{route}}', '{{object}}', '{{model}}', '{{createRequest}}', '{{updateRequest}}'];
        $replace_to = array_filter($components, fn($key) => $key !== 'filename' && $key !== 'content', ARRAY_FILTER_USE_KEY);
        $this->replaceReference($components['content'], $replacements, $replace_to, "$path\\{$components['filename']}");
        $this->info("{$components['class']} created!");
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
        $dir_name = ucfirst($model);
        $name = ucfirst($model);

        $requests = $this->getRequestsComponents($name, $dir_name);
        $replacements = ['{{class}}', '{{namespace}}'];
        $dir_path = $this->makeDirOptional("app\\Http\\Requests\\{$dir_name}");

        foreach($requests as $request) {
            if (!File::exists($request['namespace'] . $request['filename'])) {
                $this->replaceReference($request['content'], $replacements, [$request['class'], $request['namespace']], "$dir_path\\{$request['filename']}");
            }
            $this->line("{$request['filename']} is already exists!");
        }
        return $requests;
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

    private function replaceReference($content_path, $find, $replace_to, $put_path)
    {
        $file_contents = file_get_contents($content_path);
        $file_contents = str_replace($find, $replace_to, $file_contents);
        file_put_contents($put_path, $file_contents);
    }

    private function getRequestsComponents($name, $dir_name)
    {
        return [
            [
                'filename' => "Create{$name}Request.php",
                'class' => "Create{$name}Request",
                'namespace' => "App\Http\Requests\\$dir_name",
                'content' =>  "app\\Console\\Stubs\\create-request.stub"
            ],
            [
                'filename' => "Update{$name}Request.php",
                'class' => "Update{$name}Request",
                'namespace' => "App\Http\Requests\\$dir_name",
                'content' => "app\\Console\\Stubs\\update-request.stub",
            ]
        ];
    }

    private function getControllerComponents($name, $dir_path, $route, $object, $model, $requests)
    {
        return [
            'filename' => "{$name}Controller.php",
            'class' => "{$name}Controller",
            'namespace' => "$dir_path",
            'content' =>  "app\\Console\\Stubs\\custom-controller.stub",
            'route' => $route,
            'object' => $object,
            'model' => $model,
            'createRequest' => $requests[0]['class'],
            'updateRequest' => $requests[1]['class'],
        ];
    }

    private function makeDirOptional(string $dir_path)
    {
        if (!File::exists($dir_path)) {
            File::makeDirectory($dir_path);
        }
        return $dir_path;
    }
}