import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';


@Injectable({
  providedIn: 'root'
})
export class CamionService {

  constructor(public httpClient: HttpClient) { }

  findAll() {
    return this.httpClient.get('https://127.0.0.1:8000/api/camion/');
  }

  findOneById(id: number) {
    return this.httpClient.get('https://127.0.0.1:8000/api/camion/' + id);
  }

  create(camion: Camion) {
    return this.httpClient.post('https://127.0.0.1:8000/api/camion/create', camion);
  }

  update(camion: Camion) {
    return this.httpClient.post('https://127.0.0.1:8000/api/camion/' + camion.id + '/edit', camion);
  }

  remove(id: number) {
    return this.httpClient.delete('https://127.0.0.1:8000/api/camion/' + id);
  }
}
