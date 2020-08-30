import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { FruitService } from 'src/app/fruit/fruit.service';

@Component({
  selector: 'app-depot-show',
  templateUrl: './depot-show.component.html',
  styleUrls: ['./depot-show.component.scss']
})
export class DepotShowComponent implements OnInit {
  depot: Depot;
  depots: Depot;
  fruits: Fruit[] = [];

  constructor( private activatedRoute: ActivatedRoute, public fruitSrv: FruitService) {
    this.fruits = this.activatedRoute.snapshot.data['fruits'];
    this.depot = this.activatedRoute.snapshot.data['depot'];
   }

  ngOnInit() {
    this.getFruits();
  }

  getFruits() {
    const id = this.activatedRoute.snapshot.paramMap.get('id');
    return this.fruitSrv.findByDepot(id).subscribe((fruits: Fruit[])  => {
      this.fruits = fruits;
    });
  }


}
