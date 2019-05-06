<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LoadZipRangesFromSpreadsheet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zipranges:load {provider} {file} {firstLine} {lastLine} {startColumn} {endColumn} {sheet?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Loads a set of zip code ranges from a spreadsheet.';

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
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \Exception
     */
    public function handle()
    {

        $spreadsheet = IOFactory::load($this->argument('file'));

        $first = $this->argument('firstLine');
        $last = $this->argument('lastLine');

        \DB::beginTransaction();
        \DB::table('zip_ranges')->where('provider', $this->argument('provider'))->delete();
        foreach (range($first, $last) as $line) {
            $startCell = $this->argument('startColumn') . $line;
            $endCell = $this->argument('endColumn') . $line;
            $start = ($sheet = $this->argument('sheet'))
                ? (int)$spreadsheet->getSheetByName($sheet)->getCell($startCell)->getValue()
                : (int)$spreadsheet->getActiveSheet()->getCell($startCell)->getValue();
            $end = ($sheet = $this->argument('sheet'))
                ? (int)$spreadsheet->getSheetByName($sheet)->getCell($endCell)->getValue()
                : (int)$spreadsheet->getActiveSheet()->getCell($endCell)->getValue();

            \DB::table('zip_ranges')->insert([
                'provider' => $this->argument('provider'),
                'start' => $start,
                'end' => $end,
            ]);
        }
        \DB::commit();

        $this->info('Zip ranges loaded successfully');
    }
}
