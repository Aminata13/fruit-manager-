import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ChargementService } from '../chargement.service';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-chargement-list',
  templateUrl: './chargement-list.component.html',
  styleUrls: ['./chargement-list.component.scss']
})
export class ChargementListComponent implements OnInit {
  chargements: Chargement;

  constructor(private activatedRoute: ActivatedRoute) { }

  ngOnInit() {
    this.chargements = this.activatedRoute.snapshot.data['chargements'];
  }

}
