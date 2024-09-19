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

  eliminar(autor_id:number): Observable<boolean>{
    return this.autor.get<boolean>(this.apiurl + 'eliminar&autor_id=' + autor_id);
  }

  insertar(autor:Iautor): Observable<boolean>{
    return this.autor.post<boolean>(this.apiurl + 'insertar', autor);
  }

  actualizar(autor:Iautor): Observable<boolean>{
    return this.autor.post<boolean>(this.apiurl + 'actualizar', autor);
  }

  uno(autor_id:number): Observable<Iautor>{
    return this.autor.get<Iautor>(this.apiurl + 'uno&autor_id=' + autor_id);
  }
}
