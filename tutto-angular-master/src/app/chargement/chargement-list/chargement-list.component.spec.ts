import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ChargementListComponent } from './chargement-list.component';

describe('ChargementListComponent', () => {
  let component: ChargementListComponent;
  let fixture: ComponentFixture<ChargementListComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ChargementListComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ChargementListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
