<?php

namespace Ronanflavio\ArtisanMakeExtension\Console;

class MakeDto extends BaseMake
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:dto {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a Data Transfer Object (DTO)';

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
        $this->make('DataTransferObjects', 'dto');
        $this->info('DTO has been generated successfully!');
    }
}
