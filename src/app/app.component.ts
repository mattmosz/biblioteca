import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { LibroService } from './Services/libro.service';
import { Ilibro } from './Interfaces/ilibro';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'Biblioteca';

  constructor(private ServicioLibro:LibroService){}

  listaLibros:Ilibro[]=[];

  ngOnInit(){
    this.ServicioLibro.todos().subscribe(
      (data) => {this.listaLibros = data;
      console.log(this.listaLibros);
    }
    );
  }

  eliminar(libro_id:number){
    Swal.fire({
      title: '¿Está seguro que desea eliminar el libro?',
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: `Eliminar`,
      denyButtonText: `Cancelar`,
    }).then((result) => {
      if (result.isConfirmed) {
        /*this.ServicioLibro.eliminar(libro_id).subscribe(
          (data) => {
            if(data){
              Swal.fire('¡Eliminado!', '', 'success');
              this.ngOnInit();
            }else{
              Swal.fire('¡Error!', '', 'error');
            }
          }
        );*/
      }
    })
  }
}
