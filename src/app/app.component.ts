import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { LibroService } from './Services/libro.service';
import { Ilibro } from './Interfaces/ilibro';
import Swal from 'sweetalert2';
import { Iautor } from './Interfaces/iautor';
import jsPDF from 'jspdf';
import autoTable from 'jspdf-autotable';
import { AutorService } from './Services/autor.service';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'Biblioteca';

  constructor(private ServicioLibro:LibroService, private ServicioAutor:AutorService, private modalService: NgbModal){}

  listaLibros:Ilibro[]=[];
  listaAutores:Iautor[]=[];
  nuevoLibro: Ilibro = {
    libro_id: 0,
    titulo: '',
    genero: '',
    fecha_publicacion: new Date(),
    isbn: '',
    autor: ''
  };

  ngOnInit(){
    this.ServicioLibro.todos().subscribe(
      (data) => {this.listaLibros = data;
      console.log(this.listaLibros);
    }
    );
  }

  abrirModal() {
    this.modalService.open('insertarLibroModal');
  }

  insertarLibro() {
    const nuevoLibro: Ilibro = {
      libro_id: 0,
      titulo: '',
      genero: '',
      fecha_publicacion: new Date(),
      isbn: '',
      autor: ''
    };
    this.ServicioLibro.insertar(nuevoLibro).subscribe(
      (response: boolean) => {
        if (response) {
          this.listaLibros.push(nuevoLibro);
          this.modalService.dismissAll();
          this.nuevoLibro = {
            libro_id: 0,
            titulo: '',
            genero: '',
            fecha_publicacion: new Date(),
            isbn: '',
            autor: ''
          };
        } else {
          console.error('Error al insertar el libro');
        }
      },
      (error) => {
        console.error('Error al insertar el libro', error);
      }
    );
  }

  generarReporte() {
    const doc = new jsPDF();
    const col = ["#", "Titulo", "Genero", "Fecha Publicacion", "ISBN"];
    const rows: any[][] = [];

    this.listaLibros.forEach((libro, index) => {
      const temp = [
        index + 1,
        libro.titulo,
        libro.genero,
        libro.fecha_publicacion,
        libro.isbn
      ];
      rows.push(temp);
    });
    autoTable(doc, { head: [col], body: rows, startY: 10 });
    doc.save('reporte_libros.pdf');
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
        this.ServicioLibro.eliminar(libro_id).subscribe(
          (data) => {
            if(data){
              Swal.fire('¡Eliminado!', '', 'success');
              this.ngOnInit();
            }else{
              Swal.fire('¡Error!', '', 'error');
            }
          }
        );
      }
    })
  }

  insertar(titulo: string, genero: string, fecha_publicacion: string, isbn: string) {
    const nuevoLibro: Ilibro = { libro_id: 0, titulo, genero, fecha_publicacion: new Date(fecha_publicacion), isbn, autor: '' };
    this.ServicioLibro.insertar(nuevoLibro).subscribe(
      (data) => {
        if (data) {
          Swal.fire('¡Insertado!', '', 'success');
          this.ngOnInit();
        } else {
          Swal.fire('¡Error!', '', 'error');
        }
      }
    );
  }

  actualizar(libro_id: number, titulo: string, genero: string, fecha_publicacion: string, isbn: string) {
    const nuevoLibro: Ilibro = { libro_id, titulo, genero, fecha_publicacion: new Date(fecha_publicacion), isbn, autor: '' };
    this.ServicioLibro.actualizar(nuevoLibro).subscribe(
      (data) => {
        if (data) {
          Swal.fire('¡Actualizado!', '', 'success');
          this.ngOnInit();
        } else {
          Swal.fire('¡Error!', '', 'error');
        }
      }
    );
  }

  eliminarAutor(autor_id:number){
    Swal.fire({
      title: '¿Está seguro que desea eliminar el autor?',
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: `Eliminar`,
      denyButtonText: `Cancelar`,
    }).then((result) => {
      if (result.isConfirmed) {
        this.ServicioAutor.eliminarAutor(autor_id).subscribe(
          (data) => {
            if(data){
              Swal.fire('¡Eliminado!', '', 'success');
              this.ngOnInit();
            }else{
              Swal.fire('¡Error!', '', 'error');
            }
          }
        );
      }
    })
  }


}
