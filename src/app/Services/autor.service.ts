import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs/internal/Observable';
import { Iautor } from '../Interfaces/iautor';

@Injectable({
  providedIn: 'root'
})
export class AutorService {

  apiurl = 'http://localhost/ev_parcial2/libreria/controllers/autores.controller.php?op=';

  constructor(private autor:HttpClient) { }

  todos(): Observable<Iautor[]>{
    return this.autor.get<Iautor[]>(this.apiurl + 'todos');
  }
}
