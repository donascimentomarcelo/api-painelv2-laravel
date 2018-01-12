<?php

namespace Painel\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\DB;

class SetStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SetStatus:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //   $sql = DB::table('promotions')->select('id')->where('dt_end', '<', new \DateTime())->get();
        $sql = 'select id from promotions where dt_end < NOW()';
        $dados = \DB::select($sql);
        foreach($dados as $i)
        {
            $updateStatus = 'update promotions set status = "inativo" where id IN ('.$i->id.')';
            $return = \DB::update($updateStatus);
        }
        var_dump($return);
    }
}
