<?php

namespace Ronanflavio\ArtisanMakeExtension\Console;

class MakeService extends BaseMake
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a service';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed|void
     */
    public function handle()
    {
        $this->make('Services', 'service');
        $this->info('Service has been generated successfully!');
    }
}
