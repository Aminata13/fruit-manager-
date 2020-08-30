import { Route } from '@angular/router';
import { DepotListComponent } from './depot-list/depot-list.component';
import { DepotsResolver } from './depots.resolver';
import { DepotShowComponent } from './depot-show/depot-show.component';
import { DepotResolver } from './depot.resolver';
import { FruitsResolver } from '../fruit/fruits.resolver';

const depotRoutes: Route = {
  path: 'depot',
  children: [
    { path: '', component: DepotListComponent, resolve: { depots: DepotsResolver } },
    { path: ':id/show', component: DepotShowComponent, resolve: { depot: DepotResolver, fruit: FruitsResolver } }
  ]
};

export { depotRoutes };
