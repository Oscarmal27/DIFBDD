<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiarie extends Model
{
    protected $fillable = ['name','apellidoP','apellidoM','img','fechaNac','curp','noTel','claveEsc','idProg','idTipo',
                           'fechaIngreso','enhina','enhinaDoc','actaDeNac','curpDoc','compDeDom','ine','cartaDeSeg','cartaVac',
                           'compDisc','credDisc','actaConst','cartaComp','comodato','supHig','supProtCiv'];
}
