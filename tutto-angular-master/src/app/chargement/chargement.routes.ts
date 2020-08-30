import { Route } from '@angular/router';
import { ChargementListComponent } from './chargement-list/chargement-list.component';
import { ChargementsResolver } from './Chargements.resolver';
import { ChargementShowComponent } from './chargement-show/chargement-show.component';
import { ChargementResolver } from './chargement.resolver';
import { ChargementNewComponent } from './chargement-new/chargement-new.component';

const chargementRoutes: Route = {
  path: 'chargement',
  children: [
    { path: '', component: ChargementListComponent, resolve: { chargements: ChargementsResolver } },
    { path: 'new', component: ChargementNewComponent },
    { path: ':id/show', component: ChargementShowComponent, resolve: { chargement: ChargementResolver } }
  ]
};

export { chargementRoutes };
