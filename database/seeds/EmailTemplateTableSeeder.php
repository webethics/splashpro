<?php 
use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;

class EmailTemplateTableSeeder extends Seeder
{
    public function run()
    {
		$path = base_path() . '/database/seeds/data.sql';
		$sql = file_get_contents($path);
		DB::unprepared($sql);
    }
}
?>