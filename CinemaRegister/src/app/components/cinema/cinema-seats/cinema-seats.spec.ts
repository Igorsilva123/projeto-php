import { ComponentFixture, TestBed } from '@angular/core/testing';
import { CinemaSeatsComponent } from './cinema-seats';

describe('CinemaSeatsComponent', () => {
  let component: CinemaSeatsComponent;
  let fixture: ComponentFixture<CinemaSeatsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [CinemaSeatsComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(CinemaSeatsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
