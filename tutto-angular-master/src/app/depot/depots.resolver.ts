import { Injectable } from '@angular/core';
import { Resolve, ActivatedRouteSnapshot } from '@angular/router';
import { Observable, of } from 'rxjs';
import { DepotService } from './depot.service';
import { map, catchError } from 'rxjs/operators';

@Injectable({ providedIn: 'root' })
export class DepotsResolver implements Resolve<any> {
  resolve(route: ActivatedRouteSnapshot): Observable<any> | Promise<any> | any {
    return this.depotSrv.findAll().pipe(map((data: any) => {
      return data;
    }), catchError((error: any) => {
      const message = `Retrieval error: ${error}`;
      console.log(message);
      alert('erreur, regarder dans le log de la console');
      return null;
    }));
  }

  constructor(public depotSrv: DepotService) {

  }
}
