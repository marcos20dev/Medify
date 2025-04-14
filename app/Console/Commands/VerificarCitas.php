<?php
// app/Console/Commands/VerificarCitas.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cita;
use Carbon\Carbon;

class VerificarCitas extends Command
{
    // The name and signature of the console command.
    protected $signature = 'citas:verificar';

    // The console command description.
    protected $description = 'Verifica el estado de las citas y marca como perdidas si ya han pasado';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Verificando citas...');

        // Obtenemos todas las citas cuyo estado es 0 (pendiente)
        $citas = Cita::where('estado', 0)->get();

        foreach ($citas as $cita) {
            // Parseamos la hora de la cita
            $hora = $cita->horario->hora;
            $fecha = $cita->horario->fecha;
            list($horaInicio, $horaFin) = explode(' - ', $hora);

            // Convertir las horas de inicio y fin
            $horaInicio = Carbon::parse($fecha . ' ' . $horaInicio, 'America/Lima');
            $horaFin = Carbon::parse($fecha . ' ' . $horaFin, 'America/Lima');

            // Verificar si la cita ya ha pasado
            if (Carbon::now('America/Lima')->greaterThan($horaFin)) {
                // Si la cita ha pasado y no está atendida, marcarla como perdida
                if ($cita->estado == 0) {
                    $cita->estado_perdido = 1;
                    $cita->save();
                    $this->info("Cita con ID {$cita->id} marcada como perdida.");
                }
            }
        }
    }
}
