import { Component, OnInit } from '@angular/core';
import { ChargementService } from '../chargement.service';
import { CamionService } from 'src/app/camion/camion.service';
import { FormGroup, FormBuilder, Validators, FormControl } from '@angular/forms';
import { FruitService } from 'src/app/fruit/fruit.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-chargement-show',
  templateUrl: './chargement-show.component.html',
  styleUrls: ['./chargement-show.component.scss']
})
export class ChargementShowComponent implements OnInit {
  chargement: Chargement;
  camion: Camion;
  form: FormGroup;
  fruit: Fruit;
  fruits: Fruit[];
  fruitsChargement: any[];
  chargementFruit: ChargementFruit[];

  // tslint:disable-next-line: max-line-length
  constructor(public camionSrv: CamionService, public chargementSrv: ChargementService, private builder: FormBuilder, public fruitSrv: FruitService, private activatedRoute: ActivatedRoute) {
    this.chargement = this.activatedRoute.snapshot.data['chargement'];
    this.fruit = this.activatedRoute.snapshot.data['fruit'];


    const capaciteMax = this.chargement.camion.capaciteEnKg;
    this.form = this.builder.group({
      fruit: ['', Validators.required],
      quantite: ['', [Validators.required, Validators.max(capaciteMax)]]
    });

   }

   get formControlFruit() { return this.form.get('fruit'); }

   get quantite() { return this.form.get('quantite'); }

  ngOnInit() {
    this.getFruits();
    this.getFruitsByChargement();
  }

  getFruits() {
    const id = this.activatedRoute.snapshot.paramMap.get('id');
    return this.chargementSrv.findFruitsNotInChargement(id).subscribe((fruits: Fruit[])  => {
      this.fruits = fruits;
    });
  }

  getFruitsByChargement() {
    const id = this.activatedRoute.snapshot.paramMap.get('id');
    return this.chargementSrv.findFruitsByChargement(id).subscribe((fruits: any)  => {
      this.fruitsChargement = fruits;
    });
  }

  onFormSubmit() {
    console.log(this.form);
    const id = this.activatedRoute.snapshot.paramMap.get('id');
    if (this.form.valid) {
      this.form.value['chargement'] = id;
      this.chargementSrv.createChargementFruit(this.form.value).subscribe((chargementFruit: any) => {
        this.fruitsChargement.push(chargementFruit);
        console.log(chargementFruit);
      }, error => console.log(error) );
      console.log(this.form.value);
      alert('Chargement enregistré avec succès');
    }
  }

}
