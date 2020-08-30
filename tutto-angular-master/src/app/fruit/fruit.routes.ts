import { Route } from '@angular/router';
import { FruitListComponent } from './fruit-list/fruit-list.component';
import { FruitsResolver } from './fruits.resolver';


const fruitRoutes: Route = {
  path: 'fruit', component: FruitListComponent, resolve: { fruits: FruitsResolver }
};

export { fruitRoutes };
