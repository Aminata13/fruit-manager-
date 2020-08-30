import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';


@Component({
  selector: 'app-fruit-list',
  templateUrl: './fruit-list.component.html',
  styleUrls: ['./fruit-list.component.scss']
})
export class FruitListComponent implements OnInit {
  fruits: Fruit;

  constructor(private activatedRoute: ActivatedRoute) { }

  ngOnInit() {
    this.fruits = this.activatedRoute.snapshot.data['fruits'];
  }

}
