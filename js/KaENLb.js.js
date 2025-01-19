var ReactCSSTransitionGroup = React.addons.CSSTransitionGroup;

class Carousel extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      items: this.props.items,
      active: this.props.active,
      direction: '' };

    this.rightClick = this.moveRight.bind(this);
    this.leftClick = this.moveLeft.bind(this);
  }

  generateItems() {
    var items = [];
    var level;
    console.log(this.state.active);
    for (var i = this.state.active - 2; i < this.state.active + 3; i++) {
      var index = i;
      if (i < 0) {
        index = this.state.items.length + i;
      } else if (i >= this.state.items.length) {
        index = i % this.state.items.length;
      }
      level = this.state.active - i;
      items.push(React.createElement(Item, { key: index, id: this.state.items[index], level: level }));
    }
    return items;
  }

  moveLeft() {
    var newActive = this.state.active;
    newActive--;
    this.setState({
      active: newActive < 0 ? this.state.items.length - 1 : newActive,
      direction: 'left' });

  }

  moveRight() {
    var newActive = this.state.active;
    this.setState({
      active: (newActive + 1) % this.state.items.length,
      direction: 'right' });

  }

  render() {
    return (
      React.createElement("div", { id: "carousel", className: "noselect" },
      React.createElement("div", { className: "arrow arrow-left", onClick: this.leftClick }, React.createElement("i", { className: "fi-arrow-left" })),
      React.createElement(ReactCSSTransitionGroup, {
        transitionName: this.state.direction },
      this.generateItems()),

      React.createElement("div", { className: "arrow arrow-right", onClick: this.rightClick }, React.createElement("i", { className: "fi-arrow-right" }))));


  }}


class Item extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      level: this.props.level };

  }

  render() {
    const className = 'item level' + this.props.level;
    return (
      React.createElement("div", { className: className },
      this.props.id));


  }}


var items = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
ReactDOM.render(React.createElement(Carousel, { items: items, active: 0 }), document.getElementById('app'));