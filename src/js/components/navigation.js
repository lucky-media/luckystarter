export default class Navigation {
  constructor() {
    this.container = document.querySelector('.navigation');
    this.items = document.getElementById('navigationItems');

    this.btnToggle = document.getElementById('navigationToggle');
    this.openClass = 'navigation--open';
    this.overflowClass = 'overflow-hidden';

    this.btnToggle.addEventListener('click', this.toggleNavigation.bind(this));

    // On resize, close the navigation if open
    window.addEventListener('resize', () => {
      if (this.container.classList.contains(this.openClass)) {
        this.toggleNavigation();
      }
    }, {
      passive: true
    });
  }

  /**
   * Show navigation on mobile
   */
  toggleNavigation() {
    this.container.classList.toggle(this.openClass);
    document.querySelector('body').classList.toggle(this.overflowClass);
  }
}
