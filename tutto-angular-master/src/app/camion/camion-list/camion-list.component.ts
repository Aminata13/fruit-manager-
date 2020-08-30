import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-camion-list',
  templateUrl: './camion-list.component.html',
  styleUrls: ['./camion-list.component.scss']
})
export class CamionListComponent implements OnInit {
  camions: Camion;
  constructor(private activatedRoute: ActivatedRoute) { }

  ngOnInit() {
    this.camions = this.activatedRoute.snapshot.data['camions'];
  }

}
