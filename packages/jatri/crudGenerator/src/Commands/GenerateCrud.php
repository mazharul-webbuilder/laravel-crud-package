<?php

namespace Jatri\CrudGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GenerateCrud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate CRUD operations for a model';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = ucfirst($this->argument('name')); // Ensure the model name is capitalized correctly
        $pluralName = Str::plural($name); // Pluralize the model name
        $pluralNameLowerCase = strtolower($pluralName); // Lowercase plural model name

        $this->info("Generating CRUD for: $name");

        // Generate files
        $this->generateModel($name);
        $this->generateController($name, $pluralNameLowerCase);
        $this->generateRequest($name);
        $this->generateMigration($name);
        $this->updateRoutes($name, $pluralNameLowerCase);

        $this->info("CRUD generated successfully for $name!");
    }

    private function generateModel($name): void
    {
        $modelTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Model')
        );

        $path = app_path('Models');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        file_put_contents("$path/{$name}.php", $modelTemplate);
    }

    private function generateController($name, $pluralNameLowerCase): void
    {
        $controllerTemplate = str_replace(
            ['{{modelName}}', '{{modelNamePluralLowerCase}}'],
            [$name, $pluralNameLowerCase],
            $this->getStub('Controller')
        );

        $path = app_path('Http/Controllers');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        file_put_contents("$path/{$name}Controller.php", $controllerTemplate);
    }

    private function generateRequest($name): void
    {
        $requestTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Request')
        );

        $path = app_path('Http/Requests');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        file_put_contents("$path/{$name}Request.php", $requestTemplate);
    }

    private function generateMigration($name): void
    {
        $tableName = Str::snake(Str::pluralStudly($name)); // Convert to snake case and pluralize
        $migrationName = date('Y_m_d_His') . "_create_{$tableName}_table.php";
        $migrationTemplate = str_replace(
            ['{{tableName}}'],
            [$tableName],
            $this->getStub('Migration')
        );

        $path = database_path('migrations');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        file_put_contents("$path/{$migrationName}", $migrationTemplate);
    }

    private function updateRoutes($name, $pluralNameLowerCase): void
    {
        $routeTemplate = str_replace(
            ['{{modelName}}', '{{modelNamePluralLowerCase}}'],
            [$name, $pluralNameLowerCase],
            $this->getStub('Route')
        );

        File::append(base_path('routes/api.php'), $routeTemplate);
    }

    protected function getStub($type): false|string
    {
        return file_get_contents(__DIR__ . "/../stubs/$type.stub");
    }
}
