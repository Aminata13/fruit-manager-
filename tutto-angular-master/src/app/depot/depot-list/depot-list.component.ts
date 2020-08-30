import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-depot-list',
  templateUrl: './depot-list.component.html',
  styleUrls: ['./depot-list.component.scss']
})
export class DepotListComponent implements OnInit {
  depots: Depot;

  constructor(private activatedRoute: ActivatedRoute) { }

  ngOnInit() {
    this.depots = this.activatedRoute.snapshot.data['depots'];
  }

}
