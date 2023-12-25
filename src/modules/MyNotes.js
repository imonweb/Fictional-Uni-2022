import $ from 'jquery';

class MyNotes {
  constructor() {
    // alert('hello from MyNotes js');
    this.events();
  }

  events() {
    $('.delete-note').on("click", this.deleteNote);
  }

  // custom methods go here
  deleteNote() {
    alert('you clicked delete!');
  }
}

export default MyNotes;