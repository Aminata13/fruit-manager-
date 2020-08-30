import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ChargementShowComponent } from './chargement-show.component';

describe('ChargementShowComponent', () => {
  let component: ChargementShowComponent;
  let fixture: ComponentFixture<ChargementShowComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ChargementShowComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ChargementShowComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
