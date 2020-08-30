import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { of } from 'rxjs';
import { ChargementService } from '../chargement.service';
import { CamionService } from 'src/app/camion/camion.service';
import { chargementRoutes } from '../chargement.routes';
import { Router } from '@angular/router';



@Component({
  selector: 'app-chargement-new',
  templateUrl: './chargement-new.component.html',
  styleUrls: ['./chargement-new.component.scss']
})
export class ChargementNewComponent implements OnInit {
  form: FormGroup;
  camions: Camion[];
  idChargement: number;

  // tslint:disable-next-line: max-line-length
  constructor(private router: Router, private builder: FormBuilder, public camionSrv: CamionService, public chargementSrv: ChargementService) {
    this.form = this.builder.group({
      destination: ['', [Validators.required, Validators.minLength(3)]],
      camion: ['', Validators.required]
    });

   }

   get destination() { return this.form.get('destination'); }

   get camion() { return this.form.get('camion'); }

  ngOnInit() {
    this.getCamions();
  }

  getCamions() {
    return this.camionSrv.findAll().subscribe((camions: Camion[])  => {
      this.camions = camions;
    });
  }

  onFormSubmit() {
    if (this.form.valid) {
      const today = new Date();
      const numero = Math.floor(Math.random() * 1000000000);
      this.form.value['numeroChargement'] = numero;
      this.chargementSrv.create(this.form.value).subscribe((chargement: Chargement) => {
        console.log(chargement);
        this.idChargement = chargement.id;
        this.router.navigateByUrl(`/chargement/${this.idChargement}/show`);
      }, error => console.log(error) );
      console.log(this.form.value);
      alert('Chargement enregistré');
    } else {
      alert('Formulaire invalide');
    }
  }

}
