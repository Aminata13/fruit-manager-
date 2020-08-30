import { Component, OnInit } from '@angular/core';
import { CamionService } from 'src/app/camion/camion.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-statistics',
  templateUrl: './statistics.component.html',
  styleUrls: ['./statistics.component.scss']
})
export class StatisticsComponent implements OnInit {
  nombreCamion = 0;
  nombreFruit = 0;
  nombreChargement = 0;
  nombreDepot = 0;

  constructor(private activatedRoute: ActivatedRoute) { }

  ngOnInit() {
    this.nombreCamion = this.activatedRoute.snapshot.data['camions'].length;
    this.nombreFruit = this.activatedRoute.snapshot.data['fruits'].length;
    this.nombreChargement = this.activatedRoute.snapshot.data['chargements'].length;
    this.nombreDepot = this.activatedRoute.snapshot.data['depots'].length;
  }

}
