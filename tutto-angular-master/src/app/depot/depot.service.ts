import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';


@Injectable({
  providedIn: 'root'
})
export class DepotService {

  constructor(public httpClient: HttpClient) { }

  findAll() {
    return this.httpClient.get('https://127.0.0.1:8000/api/depot/');
  }

  findOneById(id: number) {
    return this.httpClient.get('https://127.0.0.1:8000/api/depot/' + id);
  }

  create(depot: Depot) {
    return this.httpClient.post('https://127.0.0.1:8000/api/depot/create', depot);
  }

  update(depot: Depot) {
    return this.httpClient.post('https://127.0.0.1:8000/api/depot/' + depot.id + '/edit', depot);
  }

  remove(id: number) {
    return this.httpClient.delete('https://127.0.0.1:8000/api/depot/' + id);
  }
}
