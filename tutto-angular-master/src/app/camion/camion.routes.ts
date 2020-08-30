import { Route } from '@angular/router';
import { CamionListComponent } from './camion-list/camion-list.component';
import { CamionsResolver } from './camions.resolver';
import { CamionNewComponent } from './camion-new/camion-new.component';
import { CamionShowComponent } from './camion-show/camion-show.component';
import { CamionResolver } from './camion.resolver';

const camionRoutes: Route = {
  path: 'camion',
  children: [
    { path: '', component: CamionListComponent, resolve: { camions: CamionsResolver } },
    { path: 'new', component: CamionNewComponent },
    { path: ':id/show', component: CamionShowComponent, resolve: { camion: CamionResolver } }
  ]
};

export { camionRoutes };
