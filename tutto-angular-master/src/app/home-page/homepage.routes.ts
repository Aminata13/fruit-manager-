import { Route } from '@angular/router';
import { StatisticsComponent } from './statistics/statistics.component';
import { CamionsResolver } from '../camion/camions.resolver';
import { FruitsResolver } from '../fruit/fruits.resolver';
import { ChargementsResolver } from '../chargement/chargements.resolver';
import { DepotsResolver } from '../depot/depots.resolver';


const homepageRoutes: Route = {
  // tslint:disable-next-line: max-line-length
  path: 'accueil', component: StatisticsComponent, resolve: {camions: CamionsResolver, fruits: FruitsResolver, chargements: ChargementsResolver, depots: DepotsResolver }
};

export { homepageRoutes };
