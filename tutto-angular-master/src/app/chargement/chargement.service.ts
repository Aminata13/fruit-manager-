import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';


@Injectable({
  providedIn: 'root'
})
export class ChargementService {

  constructor(public httpClient: HttpClient) { }

  findAll() {
    return this.httpClient.get('https://127.0.0.1:8000/api/chargement/');
  }

  findOneById(id: number) {
    return this.httpClient.get('https://127.0.0.1:8000/api/chargement/' + id);
  }

  findFruitsByChargement(id: any) {
    return this.httpClient.get('https://127.0.0.1:8000/api/chargement-fruit/chargement/' + id);
  }

  findFruitsNotInChargement(id: any) {
    return this.httpClient.get('https://127.0.0.1:8000/api/chargement-fruit/not/chargement/' + id);
  }

  create(chargement: Chargement) {
    return this.httpClient.post('https://127.0.0.1:8000/api/chargement/create', chargement);
  }

  createChargementFruit(chargementFruit: ChargementFruit) {
    return this.httpClient.post('https://127.0.0.1:8000/api/chargement-fruit/create', chargementFruit);
  }


  update(chargement: Chargement) {
    return this.httpClient.post('https://127.0.0.1:8000/api/chargement/' + chargement.id + '/edit', chargement);
  }

  remove(id: number) {
    return this.httpClient.delete('https://127.0.0.1:8000/api/chargement/' + id);
  }
}
