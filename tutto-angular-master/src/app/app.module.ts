import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { CollectionPipesModule } from 'ng-pipes';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { CamionListComponent } from './camion/camion-list/camion-list.component';
import { CamionNewComponent } from './camion/camion-new/camion-new.component';
import { CamionShowComponent } from './camion/camion-show/camion-show.component';
import { HttpClientModule } from '@angular/common/http';
import { FruitListComponent } from './fruit/fruit-list/fruit-list.component';
import { ChargementListComponent } from './chargement/chargement-list/chargement-list.component';
import { ChargementShowComponent } from './chargement/chargement-show/chargement-show.component';
import { ChargementNewComponent } from './chargement/chargement-new/chargement-new.component';
import { ReactiveFormsModule } from '@angular/forms';
import { DepotListComponent } from './depot/depot-list/depot-list.component';
import { DepotShowComponent } from './depot/depot-show/depot-show.component';
import { StatisticsComponent } from './home-page/statistics/statistics.component';

@NgModule({
  declarations: [
    AppComponent,
    CamionListComponent,
    CamionNewComponent,
    CamionShowComponent,
    FruitListComponent,
    ChargementListComponent,
    ChargementShowComponent,
    ChargementNewComponent,
    DepotListComponent,
    DepotShowComponent,
    StatisticsComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    ReactiveFormsModule,
    CollectionPipesModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
