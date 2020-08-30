import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { DepotService } from '../depot/depot.service';


@Injectable({
  providedIn: 'root'
})
export class FruitService {

  constructor(public httpClient: HttpClient, public depotSrv: DepotService) { }

  findAll() {
    return this.httpClient.get('https://127.0.0.1:8000/api/fruit/');
  }

  findByDepot(id: any) {
    return this.httpClient.get('https://127.0.0.1:8000/api/fruit/depot/' + id);
  }

  findOneById(id: number) {
    return this.httpClient.get('https://127.0.0.1:8000/api/fruit/' + id);
  }

  create(fruit: Fruit) {
    return this.httpClient.post('https://127.0.0.1:8000/api/fruit/create', fruit);
  }

  update(fruit: Fruit) {
    return this.httpClient.post('https://127.0.0.1:8000/api/fruit/' + fruit.id + '/edit', fruit);
  }

  remove(id: number) {
    return this.httpClient.delete('https://127.0.0.1:8000/api/fruit/' + id);
  }
}
