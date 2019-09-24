import { A } from '@ember/array';
import Component from '@ember/component';
import { set, observer } from '@ember/object';



export default Component.extend({
    todos: null,
    completed: 0,
    notCompleted: 0,

    init() {
        this._super();
        this.set('todos', A());
        Ember.$.getJSON('http://localhost:8000/Todos/').then(val => {
            val.forEach(element => {
                this.todos.pushObject({ id: element.id, title: element.title, isDone: element.isDone, editable: false });
            });
            this.set('completed', this.todos.filter(t => t.isDone).length);
            this.set('notCompleted', this.todos.filter(t => !t.isDone).length);
        })

    },
    actions: {
        add() {
            this.todos.pushObject({ title: '', isDone: false, editable: true });
        },

        remove(index) {
            var todo = this.todos.objectAt(index);
            this.todos.removeAt(index);
            if (todo.id) {
                $.ajax({
                    type: 'DELETE',
                    url: 'http://localhost:8000/Todos/destroy/' + todo.id,
                })
            }
        },

        save(todo) {
            set(todo, 'editable', false);
            if (todo.id) {
                $.ajax({
                    type: 'POST',
                    contentType: 'application/json',
                    url: 'http://localhost:8000/Todos/update/' + todo.id,
                    data: JSON.stringify({ title: todo.title, isDone: todo.isDone }),
                })
            }
            //create new
            else {
                $.ajax({
                    type: 'POST',
                    contentType: 'application/json',
                    url: 'http://localhost:8000/Todos/store',
                    data: JSON.stringify({ title: todo.title, isDone: todo.isDone }),
                })
            }
        },

        edit(todo) {
            set(todo, 'editable', true);
        },

        toggleDone(todo) {
            set(todo, 'isDone', !todo.isDone);
            this.actions.save(todo);
        },
    }
});
