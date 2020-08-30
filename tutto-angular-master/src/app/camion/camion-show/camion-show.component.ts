import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-camion-show',
  templateUrl: './camion-show.component.html',
  styleUrls: ['./camion-show.component.scss']
})
export class CamionShowComponent implements OnInit {
  camion: Camion;
  constructor(private activatedRoute: ActivatedRoute) { }

  ngOnInit() {
    this.camion = this.activatedRoute.snapshot.data['camion'];
  }

}
