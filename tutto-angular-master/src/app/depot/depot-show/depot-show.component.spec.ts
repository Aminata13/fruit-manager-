import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DepotShowComponent } from './depot-show.component';

describe('DepotShowComponent', () => {
  let component: DepotShowComponent;
  let fixture: ComponentFixture<DepotShowComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DepotShowComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DepotShowComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
