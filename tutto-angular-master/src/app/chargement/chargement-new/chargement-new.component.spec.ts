import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ChargementNewComponent } from './chargement-new.component';

describe('ChargementNewComponent', () => {
  let component: ChargementNewComponent;
  let fixture: ComponentFixture<ChargementNewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ChargementNewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ChargementNewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
