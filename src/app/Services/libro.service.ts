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
}
