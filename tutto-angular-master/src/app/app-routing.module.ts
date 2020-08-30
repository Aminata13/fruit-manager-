import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { camionRoutes } from './camion/camion.routes';
import { fruitRoutes } from './fruit/fruit.routes';
import { chargementRoutes } from './chargement/chargement.routes';
import { depotRoutes } from './depot/depot.routes';
import { homepageRoutes } from './home-page/homepage.routes';

const routes: Routes = [
  camionRoutes,
  fruitRoutes,
  chargementRoutes,
  depotRoutes,
  homepageRoutes
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
