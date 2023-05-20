<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class MakeCrudCmd extends GeneratorCommand
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    // generator models
    protected $class;
    protected $model;
    protected $model_normal;
    protected $model_lower;
    protected $model_kebab;
    protected $table;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bambo:crud {model?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Laravel + Livewire CRUD for a given model';

    public function __construct(Filesystem $files)
    {
        parent::__construct($files);
        $this->file = $files;
    }

    public function getTableKebabCaseName()
    {
        $parts = explode('_', $this->table);
        return Str::singular(join('-', $parts));
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $modelArgument = null;
        if ($this->hasArgument('model') && $this->argument('model')) {
            $modelArgument = $this->argument('model');
        } else {
            $modelArgument = $this->ask("Saisir le nom du modèle (class)");
        }
        $this->class = ucfirst($modelArgument);
        $classWithNamespace = "App\Models\\" . $this->class;
        $this->model = new $classWithNamespace;
        $this->table = $this->model->getTable();
        $this->model_normal = Str::lcfirst($this->class);
        $this->model_lower = Str::lower($this->class);
        $this->model_kebab = $this->getTableKebabCaseName();

        $this->info("Génération du CRUD : $this->table");
        $this->info("Génération du contenu WEB...");
        $this->makeWebController();
        $this->makeWebIndexPage();
        $this->makeWebShowPage();
        $this->info("Génération des composant Laravel");
        $this->makeComponentIndexController();
        $this->makeComponentIndexPage();
        $this->info("Génération du contenu Livewire...");
        $this->makeLivewireListController();
        $this->makeLivewireNewController();
        $this->makeLivewireShowController();
        $this->makeLivewireEditController();
        $this->makeLivewireListPage();
        $this->makeLivewireEditPage();
        $this->makeLivewireNewPage();
        $this->makeLivewireShowPage();
        $this->addRouteToWeb();
        return Command::SUCCESS;
    }

    public function makeWebController()
    {
        // get controller stub
        $stub = $this->files->get(resource_path('crud/stubs/web/controllers') . '/controller.stub');
        // replace class in stub
        $stub = Str::replace('{{ class }}', $this->class, $stub);
        $stub = Str::replace('{{ model_lower }}', $this->model_lower, $stub);
        // replace model in stub
        $stub = Str::replace('{{ model }}', $this->model_normal, $stub);
        // stocker le controller dans son répertoire
        $targetPath = app_path('Http/Controllers');
        if (!$this->files->exists($targetPath)) {
            $this->files->makeDirectory($targetPath);
        }
        $controllerName = $this->class . "Controller";
        // check if controller already exist
        if ($this->files->exists("$targetPath/$controllerName.php")) {
            $this->info("$controllerName existe déja dans $targetPath.");
            return Command::FAILURE;
        }
        if ($this->files->put("$targetPath/$controllerName.php", $stub)) {
            $this->info("$controllerName généré dans le repertoire $targetPath");
        }
    }

    public function makeWebIndexPage()
    {
        $stub = $this->files->get(resource_path('crud/stubs/web/views/index.stub'));
        $targetPath = resource_path('views/app/' . Str::lower($this->class));
        if (!$this->files->exists($targetPath)) {
            $this->files->makeDirectory($targetPath);
        }
        $stub = Str::replace('{{ model }}', $this->model_normal, $stub);
        $stub = Str::replace('{{ model_lower }}', $this->model_lower, $stub);
        $filename = "index.blade.php";
        if ($this->files->exists("$targetPath/$filename")) {
            $this->info("$filename existe déja dans $targetPath.");
            return Command::FAILURE;
        }
        if ($this->files->put("$targetPath/$filename", $stub)) {
            $this->info("$filename généré dans le repertoire $targetPath");
        }
    }

    public function makeComponentIndexController()
    {
        $stub = $this->files->get(resource_path('crud/stubs/components/controllers/index-controller.stub'));
        $targetPath = app_path('View/Components/' . $this->class);
        if (!$this->files->exists($targetPath)) {
            $this->files->makeDirectory($targetPath);
        }
        $stub = Str::replace('{{ class }}', $this->class, $stub);
        $stub = Str::replace('{{ model_lower }}', $this->model_lower, $stub);
        $filename = $this->class . "Index.php";
        if ($this->files->exists("$targetPath/$filename")) {
            $this->info("$filename existe déja dans $targetPath.");
            return Command::FAILURE;
        }
        if ($this->files->put("$targetPath/$filename", $stub)) {
            $this->info("$filename généré dans le repertoire $targetPath");
        }
    }

    public function makeComponentIndexPage()
    {
        $stub = $this->files->get(resource_path('crud/stubs/components/views/index-page.stub'));
        $targetPath = resource_path('views/components/app/' . $this->model_lower);
        if (!$this->files->exists($targetPath)) {
            $this->files->makeDirectory($targetPath);
        }
        // replace class in stub
        $stub = Str::replace('{{ class }}', $this->class, $stub);
        $stub = Str::replace('{{ model_lower }}', $this->model_lower, $stub);
        $stub = Str::replace('{{ model_kebab }}', $this->model_kebab, $stub);
        // replace model in stub
        $stub = Str::replace('{{ model }}', $this->model_normal, $stub);
        // check if controller already exist
        $filename = $this->model_lower . '-index.blade.php';
        if ($this->files->exists("$targetPath/$filename")) {
            $this->info("$filename existe déja dans $targetPath.");
            return Command::FAILURE;
        }
        if ($this->files->put("$targetPath/$filename", $stub)) {
            $this->info("$filename généré dans le repertoire $targetPath");
        }
    }

    public function makeWebShowPage()
    {
        $stub = $this->files->get(resource_path('crud/stubs/web/views/show.stub'));
        $targetPath = resource_path('views/app/' . $this->model_lower);
        if (!$this->files->exists($targetPath)) {
            $this->files->makeDirectory($targetPath);
        }
        // replace class in stub
        $stub = Str::replace('{{ class }}', $this->class, $stub);
        $stub = Str::replace('{{ model_lower }}', $this->model_lower, $stub);
        $stub = Str::replace('{{ model_kebab }}', $this->model_kebab, $stub);
        // replace model in stub
        $stub = Str::replace('{{ model }}', $this->model_normal, $stub);
        // check if controller already exist
        $filename = 'show.blade.php';
        if ($this->files->exists("$targetPath/$filename")) {
            $this->info("$filename existe déja dans $targetPath.");
            return Command::FAILURE;
        }
        if ($this->files->put("$targetPath/$filename", $stub)) {
            $this->info("$filename généré dans le repertoire $targetPath");
        }
    }

    public function makeLivewireListController()
    {
        // get controller stub
        $stub = $this->files->get(resource_path('crud/stubs/livewire/controllers') . '/list-controller.stub');
        // replace class in stub
        $stub = Str::replace('{{ class }}', $this->class, $stub);
        $stub = Str::replace('{{ model_lower }}', $this->model_lower, $stub);
        $stub = Str::replace('{{ model_kebab }}', $this->model_kebab, $stub);
        // replace model in stub
        $stub = Str::replace('{{ model }}', $this->model_normal, $stub);
        // stocker le controller dans son répertoire
        $targetPath = app_path("Http/Livewire/App/$this->class");
        if (!$this->files->exists($targetPath)) {
            $this->files->makeDirectory($targetPath);
        }
        $controllerName = $this->class . "List.php";
        // check if controller already exist
        if ($this->files->exists("$targetPath/$controllerName")) {
            $this->info("$controllerName existe déja dans $targetPath.");
            return Command::FAILURE;
        }
        if ($this->files->put("$targetPath/$controllerName", $stub)) {
            $this->info("$controllerName généré dans le repertoire $targetPath");
        }
    }

    public function makeLivewireListPage()
    {
        // get controller stub
        $stub = $this->files->get(resource_path('crud/stubs/livewire/views') . '/list.stub');
        // replace model in stub
        $stub = Str::replace('{{ model }}', $this->model_normal, $stub);
        $stub = Str::replace('{{ model_lower }}', $this->model_lower, $stub);
        // générer le header
        $listHeaderCols = $this->buildListHeaderCols();
        $stub = Str::replace('{{ header_cols }}', $listHeaderCols, $stub);
        // générer le body
        $listBodyCols = $this->buildListBodyCols();
        $stub = Str::replace('{{ body_cols }}', $listBodyCols, $stub);
        // stocker le controller dans son répertoire
        $targetPath = resource_path("views/livewire/app/" . $this->model_kebab);
        if (!$this->files->exists($targetPath)) {
            $this->files->makeDirectory($targetPath);
        }
        $pageName = $this->model_kebab . "-list.blade.php";
        // check if controller already exist
        if ($this->files->exists("$targetPath/$pageName")) {
            $this->info("$pageName existe déja dans $targetPath.");
            return Command::FAILURE;
        }
        if ($this->files->put("$targetPath/$pageName", $stub)) {
            $this->info("$pageName généré dans le repertoire $targetPath");
        }
    }

    public function makeLivewireEditController()
    {
        // get controller stub
        $stub = $this->files->get(resource_path('crud/stubs/livewire/controllers') . '/edit-controller.stub');
        // replace class in stub
        $stub = Str::replace('{{ class }}', $this->class, $stub);
        $stub = Str::replace('{{ model_lower }}', $this->model_lower, $stub);
        $stub = Str::replace('{{ model_kebab }}', $this->model_kebab, $stub);
        // replace model in stub
        $stub = Str::replace('{{ model }}', $this->model_normal, $stub);
        // générer les régles de validation
        $validationRuleStub = $this->files->get(resource_path('crud/stubs/livewire/controllers') . '/validation-rule.stub');
        $validationRules = '';
        $columns = Schema::getColumnListing($this->model->getTable());
        foreach ($columns as $column) {
            if (!in_array($column, ['created_at', 'updated_at', 'id'])) {
                $validationRuleCode = Str::replace('{{ model }}', $this->model_normal, $validationRuleStub);
                $validationRuleCode = Str::replace('{{ attribute }}', $column, $validationRuleCode);
                $validationRules = $validationRules . PHP_EOL . $validationRuleCode;
            }
        }
        $stub = Str::replace('{{ validation_rules }}', $validationRules, $stub);
        // stocker le controller dans son répertoire
        $targetPath = app_path("Http/Livewire/App/$this->class");
        if (!$this->files->exists($targetPath)) {
            $this->files->makeDirectory($targetPath);
        }
        $controllerName = $this->class . "Edit.php";
        // check if controller already exist
        if ($this->files->exists("$targetPath/$controllerName")) {
            $this->info("$controllerName existe déja dans $targetPath.");
            return Command::FAILURE;
        }
        if ($this->files->put("$targetPath/$controllerName", $stub)) {
            $this->info("$controllerName généré dans le repertoire $targetPath");
        }
    }

    public function makeLivewireEditPage()
    {
        // get controller stub
        $stub = $this->files->get(resource_path('crud/stubs/livewire/views') . '/edit.stub');
        // générer les colonnes du formulaires
        $formCols = $this->buildFormCols();
        $stub = Str::replace('{{ form_cols }}', $formCols, $stub);
        // stocker le controller dans son répertoire
        $targetPath = resource_path("views/livewire/app/" . $this->model_kebab);
        if (!$this->files->exists($targetPath)) {
            $this->files->makeDirectory($targetPath);
        }
        $pageName = $this->model_kebab . "-edit.blade.php";
        // check if controller already exist
        if ($this->files->exists("$targetPath/$pageName")) {
            $this->info("$pageName existe déja dans $targetPath.");
            return Command::FAILURE;
        }
        if ($this->files->put("$targetPath/$pageName", $stub)) {
            $this->info("$pageName généré dans le repertoire $targetPath");
        }
    }

    public function makeLivewireNewController()
    {
        // get controller stub
        $stub = $this->files->get(resource_path('crud/stubs/livewire/controllers') . '/new-controller.stub');
        // replace class in stub
        $stub = Str::replace('{{ class }}', $this->class, $stub);
        $stub = Str::replace('{{ model_lower }}', $this->model_lower, $stub);
        $stub = Str::replace('{{ model_kebab }}', $this->model_kebab, $stub);
        // replace model in stub
        $stub = Str::replace('{{ model }}', $this->model_normal, $stub);
        // générer les régles de validation
        $validationRuleStub = $this->files->get(resource_path('crud/stubs/livewire/controllers') . '/validation-rule.stub');
        $validationRules = '';
        $columns = Schema::getColumnListing($this->model->getTable());
        foreach ($columns as $column) {
            if (!in_array($column, ['created_at', 'updated_at', 'id'])) {
                $validationRuleCode = Str::replace('{{ model }}', $this->model_normal, $validationRuleStub);
                $validationRuleCode = Str::replace('{{ attribute }}', $column, $validationRuleCode);
                $validationRules = $validationRules . PHP_EOL . $validationRuleCode;
            }
        }
        $stub = Str::replace('{{ validation_rules }}', $validationRules, $stub);
        // stocker le controller dans son répertoire
        $targetPath = app_path("Http/Livewire/App/$this->class");
        if (!$this->files->exists($targetPath)) {
            $this->files->makeDirectory($targetPath);
        }
        $controllerName = $this->class . "New.php";
        // check if controller already exist
        if ($this->files->exists("$targetPath/$controllerName")) {
            $this->info("$controllerName existe déja dans $targetPath.");
            return Command::FAILURE;
        }
        if ($this->files->put("$targetPath/$controllerName", $stub)) {
            $this->info("$controllerName généré dans le repertoire $targetPath");
        }
    }
    public function makeLivewireNewPage()
    {
        // get controller stub
        $stub = $this->files->get(resource_path('crud/stubs/livewire/views') . '/new.stub');
        // générer les colonnes du formulaires
        $formCols = $this->buildFormCols();
        $stub = Str::replace('{{ form_cols }}', $formCols, $stub);
        // stocker le controller dans son répertoire
        $targetPath = resource_path("views/livewire/app/" . $this->model_kebab);
        if (!$this->files->exists($targetPath)) {
            $this->files->makeDirectory($targetPath);
        }
        $pageName = $this->model_kebab . "-new.blade.php";
        // check if controller already exist
        if ($this->files->exists("$targetPath/$pageName")) {
            $this->info("$pageName existe déja dans $targetPath.");
            return Command::FAILURE;
        }
        if ($this->files->put("$targetPath/$pageName", $stub)) {
            $this->info("$pageName généré dans le repertoire $targetPath");
        }
    }

    public function makeLivewireShowController()
    {
        // get controller stub
        $stub = $this->files->get(resource_path('crud/stubs/livewire/controllers') . '/show-controller.stub');
        // replace class in stub
        $stub = Str::replace('{{ class }}', $this->class, $stub);
        $stub = Str::replace('{{ model_lower }}', $this->model_lower, $stub);
        $stub = Str::replace('{{ model_kebab }}', $this->model_kebab, $stub);
        // replace model in stub
        $stub = Str::replace('{{ model }}', $this->model_normal, $stub);
        // stocker le controller dans son répertoire
        $targetPath = app_path("Http/Livewire/App/$this->class");
        if (!$this->files->exists($targetPath)) {
            $this->files->makeDirectory($targetPath);
        }
        $controllerName = $this->class . "Show.php";
        // check if controller already exist
        if ($this->files->exists("$targetPath/$controllerName")) {
            $this->info("$controllerName existe déja dans $targetPath.");
            return Command::FAILURE;
        }
        if ($this->files->put("$targetPath/$controllerName", $stub)) {
            $this->info("$controllerName généré dans le repertoire $targetPath");
        }
    }

    public function makeLivewireShowPage()
    {
        // get controller stub
        $stub = $this->files->get(resource_path('crud/stubs/livewire/views') . '/show.stub');
        // replace model in stub
        $stub = Str::replace('{{ model }}', $this->model_normal, $stub);
        $stub = Str::replace('{{ model_lower }}', $this->model_lower, $stub);
        // générer les colonnes du tableau dans show
        $showCols = $this->buildShowCols();
        $stub = Str::replace('{{ show_cols }}', $showCols, $stub);
        // stocker le controller dans son répertoire
        $targetPath = resource_path("views/livewire/app/" . $this->model_kebab);
        if (!$this->files->exists($targetPath)) {
            $this->files->makeDirectory($targetPath);
        }
        $pageName = $this->model_kebab . "-show.blade.php";
        // check if controller already exist
        if ($this->files->exists("$targetPath/$pageName")) {
            $this->info("$pageName existe déja dans $targetPath.");
            return Command::FAILURE;
        }
        if ($this->files->put("$targetPath/$pageName", $stub)) {
            $this->info("$pageName généré dans le repertoire $targetPath");
        }
    }

    /**
     * Générer les colonnes des formulaires edit et new
     */
    public function buildFormCols()
    {
        $columns = Schema::getColumnListing($this->model->getTable());
        $formColStub = $this->files->get(resource_path('crud/stubs/livewire/views') . '/form-col.stub');
        $formCols = '';
        foreach ($columns as $column) {
            if (!in_array($column, ['created_at', 'updated_at', 'id'])) {
                $formColCode = Str::replace('{{ model }}', $this->model_normal, $formColStub);
                $formColCode = Str::replace('{{ attribute }}', $column, $formColCode);
                $columnType = Schema::getColumnType($this->model->getTable(), $column);
                $fieldType = 'text';
                if (in_array($columnType, ['date'])) {
                    $fieldType = 'date';
                } elseif (in_array($columnType, ['datetime'])) {
                    $fieldType = 'datetime-local';
                } elseif (in_array($columnType, ['boolean'])) {
                    $fieldType = 'checkbox';
                } elseif (in_array($columnType, ['integer', 'bigint'])) {
                    $fieldType = 'number';
                }
                $formColCode = Str::replace('{{ attribute_label }}', Str::ucfirst($column), $formColCode);
                $formColCode = Str::replace('{{ attribute_type }}', $fieldType, $formColCode);
                $formCols = $formCols . PHP_EOL . $formColCode;
            }
        }
        return $formCols;
    }
    /**
     * Générer les entête du tableau de la liste principale
     */
    public function buildListHeaderCols()
    {
        $listHeaderColStub = $this->files->get(resource_path('crud/stubs/livewire/views') . '/list-header-col.stub');
        $listHeaderCols = '';
        $columns = Schema::getColumnListing($this->model->getTable());
        foreach ($columns as $column) {
            if (!in_array($column, ['created_at', 'updated_at', 'id'])) {
                $validationRuleCode = Str::replace('{{ attribute_label }}', ucfirst($column), $listHeaderColStub);
                $listHeaderCols = $listHeaderCols . PHP_EOL . $validationRuleCode;
            }
        }
        return $listHeaderCols;
    }
    /**
     * générer les colonnes du tableau de la liste principale
     */
    public function buildListBodyCols()
    {
        $listBodyColStub = $this->files->get(resource_path('crud/stubs/livewire/views') . '/list-body-col.stub');
        $listBodyCols = '';
        $columns = Schema::getColumnListing($this->model->getTable());
        foreach ($columns as $column) {
            if (!in_array($column, ['created_at', 'updated_at', 'id'])) {
                $listBodyCode = Str::replace('{{ model }}', $this->model_normal, $listBodyColStub);
                $listBodyCode = Str::replace('{{ attribute }}', $column, $listBodyCode);
                $listBodyCols = $listBodyCols . PHP_EOL . $listBodyCode;
            }
        }
        return $listBodyCols;
    }
    /**
     * Générer les colonnes du tableau de la page show
     */
    public function buildShowCols()
    {
        $showColStub = $this->files->get(resource_path('crud/stubs/livewire/views') . '/show-col.stub');
        $showCols = '';
        $columns = Schema::getColumnListing($this->model->getTable());
        foreach ($columns as $column) {
            if (!in_array($column, ['created_at', 'updated_at', 'id'])) {
                $showColCode = Str::replace('{{ model }}', $this->model_normal, $showColStub);
                $showColCode = Str::replace('{{ attribute }}', $column, $showColCode);
                $showColCode = Str::replace('{{ attribute_label }}', Str::ucfirst($column), $showColCode);
                $showCols = $showCols . PHP_EOL . $showColCode;
            }
        }
        return $showCols;
    }

    public function addRouteToWeb()
    {
        $resourceRouteStub = $this->files->get(resource_path('crud/stubs/web/routes') . '/resource-route.stub');
        $resourceRouteCode = Str::replace('{{ model }}', $this->model_normal, $resourceRouteStub);
        $resourceRouteCode = Str::replace('{{ model_lower }}', $this->model_lower, $resourceRouteCode);
        $resourceRouteCode = Str::replace('{{ class }}', $this->class, $resourceRouteCode);
        // apprend the code to routes/web.php
        $webRoutePath = resource_path('./../routes/web.php');
        $webRouteCode = $this->files->get($webRoutePath) . PHP_EOL . $resourceRouteCode;
        if ($this->files->put($webRoutePath, $webRouteCode)) {
            $this->info("La route de la ressource {$this->class} est ajoutée à routes/web.php");
        }
    }

    protected function getStub()
    {
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        return $path;
    }
}
