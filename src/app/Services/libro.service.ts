import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Ilibro } from '../Interfaces/ilibro';

@Injectable({
  providedIn: 'root'
})
export class LibroService {

  apiurl = 'http://localhost/ev_parcial2/libreria/controllers/libros.controller.php?op=';

  constructor(private lector: HttpClient) { }

  todos(): Observable<Ilibro[]> {
    return this.lector.get<Ilibro[]>(this.apiurl + 'todos')
  }

  eliminar(libro_id: number): Observable<boolean> {
    return this.lector.get<boolean>(this.apiurl + 'eliminar&libro_id=' + libro_id)
  }

  insertar(libro: Ilibro): Observable<boolean> {
    return this.lector.post<boolean>(this.apiurl + 'insertar', libro)
  }

  actualizar(libro: Ilibro): Observable<boolean> {
    return this.lector.post<boolean>(this.apiurl + 'actualizar', libro)
  }

  uno(libro_id: number): Observable<Ilibro> {
    return this.lector.get<Ilibro>(this.apiurl + 'uno&libro_id=' + libro_id)
  }
}
