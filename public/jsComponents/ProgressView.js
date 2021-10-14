var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var TableRow = function (_React$Component) {
    _inherits(TableRow, _React$Component);

    function TableRow(props) {
        _classCallCheck(this, TableRow);

        var _this = _possibleConstructorReturn(this, (TableRow.__proto__ || Object.getPrototypeOf(TableRow)).call(this, props));

        _this.state = {
            operationnalCompetences: []
        };
        return _this;
    }

    _createClass(TableRow, [{
        key: 'render',
        value: function render() {
            var _this2 = this;

            return React.createElement(
                'tr',
                null,
                React.createElement(CompetenceDomainView, { mobiledisplay: this.props.mobiledisplay,
                    competenceDomainSymbol: this.props.coursePlanRows.competenceDomainSymbol,
                    competenceDomainName: this.props.coursePlanRows.competenceDomainName,
                    competenceDomainDatas: this.props.coursePlanRows.competenceDomain }),
                this.props.coursePlanRows.operationnalCompetences.forEach(function (operationalCompetence) {
                    _this2.state.operationnalCompetences.push(React.createElement(OperationalCompetenceView, {
                        mobiledisplay: _this2.props.mobiledisplay,
                        operationalCompetenceSymbol: operationalCompetence.symbol,
                        operationalCompetenceName: operationalCompetence.name,
                        operationalCompetenceDatas: operationalCompetence.operationnalCompetence }));
                }),
                this.state.operationnalCompetences
            );
        }
    }]);

    return TableRow;
}(React.Component);

var Frame = function (_React$Component2) {
    _inherits(Frame, _React$Component2);

    function Frame(props) {
        _classCallCheck(this, Frame);

        return _possibleConstructorReturn(this, (Frame.__proto__ || Object.getPrototypeOf(Frame)).call(this, props));
    }

    _createClass(Frame, [{
        key: 'componentDidMount',
        value: function componentDidMount() {}
    }, {
        key: 'render',
        value: function render() {
            this.list = [];
            Object.values(this.props.operationnalCompetences).forEach(function (opcomp) {});
            return React.createElement(
                'div',
                { style: { display: 'contents' } },
                this.list
            );
        }
    }]);

    return Frame;
}(React.Component);

var ProgressView = function (_React$Component3) {
    _inherits(ProgressView, _React$Component3);

    function ProgressView(props) {
        _classCallCheck(this, ProgressView);

        var _this4 = _possibleConstructorReturn(this, (ProgressView.__proto__ || Object.getPrototypeOf(ProgressView)).call(this, props));

        _this4.tableRows = [];
        _this4.competenceDomains = [];
        _this4.operationalCompetences = [];
        _this4.listbtn = React.createRef();

        _this4.refreshComponent = function (e) {
            if (window.innerWidth > 950) {
                _this4.setState({
                    mobiledisplay: false
                });
            } else {
                _this4.setState({
                    mobiledisplay: true
                });
            }
        };

        _this4.state = {
            mobiledisplay: window.innerWidth < 950,
            page: 1
        };
        _this4.hideMenu = _this4.hideMenu.bind(_this4);
        _this4.showMenu = _this4.showMenu.bind(_this4);

        return _this4;
    }

    _createClass(ProgressView, [{
        key: 'componentDidMount',
        value: function componentDidMount() {
            window.innerWidth > 950 ? this.setState({
                mobiledisplay: false
            }) : this.setState({
                mobiledisplay: true
            });

            window.addEventListener('resize', this.refreshComponent);
        }
    }, {
        key: 'componentWillUnmount',
        value: function componentWillUnmount() {
            window.removeEventListener('resize', this.refreshComponent);
        }
    }, {
        key: 'render',
        value: function render() {
            var _this5 = this;

            this.competenceDomains = [];
            var intermediateList = [];
            this.tableRows = [];
            if (this.state.mobiledisplay) {
                return React.createElement(
                    'div',
                    { id: 'detailsFrame' },
                    React.createElement(
                        'div',
                        { id: 'opcompList' },
                        React.createElement(
                            'div',
                            { id: 'leftColumn' },
                            React.createElement(
                                'span',
                                { id: 'listbtn', ref: this.listbtn, onClick: function onClick(e) {
                                        return _this5.hideMenu();
                                    } },
                                React.createElement('i', { className: 'bi bi-list' })
                            ),
                            Object.values(this.props.coursePlan.competenceDomains).forEach(function (competenceDomain) {
                                _this5.competenceDomains.push(React.createElement(CompetenceDomainView, { mobiledisplay: true, competenceDomainDatas: competenceDomain, competenceDomainName: competenceDomain.name, competenceDomainSymbol: competenceDomain.symbol, onClick: function onClick(opcomps) {
                                        _this5.hideMenu();
                                        _this5.setState({ page: competenceDomain.id });
                                    } }));
                                intermediateList = [];
                                Object.values(competenceDomain.operationalCompetences).forEach(function (operationalCompetence) {
                                    intermediateList.push(React.createElement(OperationalCompetenceView, { key: operationalCompetence.id, operationalCompetenceSymbol: operationalCompetence.symbol, operationalCompetenceName: operationalCompetence.name, operationalCompetenceDatas: operationalCompetence, mobiledisplay: true }));
                                });
                                _this5.operationalCompetences[competenceDomain.id] = intermediateList;
                            }),
                            this.competenceDomains
                        ),
                        React.createElement(
                            'span',
                            { id: 'closelbtn', onClick: function onClick(e) {
                                    return _this5.showMenu();
                                } },
                            React.createElement('i', { className: 'bi bi-list' })
                        ),
                        this.operationalCompetences[this.state.page],
                        React.createElement('i', { className: 'bi bi-x-circle-fill', id: 'exitdetails', onClick: function onClick() {
                                _this5.props.callback();
                            } })
                    )
                );
            } else {
                return React.createElement(
                    'div',
                    { id: 'detailsFrame' },
                    React.createElement(
                        'div',
                        { style: { display: 'flex', justifyContent: 'center', width: '90%' } },
                        React.createElement(
                            'table',
                            { id: 'courseplandetails', className: "table",
                                style: { tableLayout: 'fixed', width: '100%' } },
                            React.createElement(
                                'thead',
                                { className: 'table-dark bg-primary' },
                                React.createElement(
                                    'tr',
                                    null,
                                    React.createElement(
                                        'th',
                                        { style: { width: '13%' } },
                                        'competence domain'
                                    ),
                                    React.createElement(
                                        'th',
                                        { colSpan: 21 },
                                        'operational competences'
                                    ),
                                    React.createElement('i', { className: 'bi bi-x-circle-fill', id: 'exitdetails', onClick: function onClick() {
                                            _this5.props.callback();
                                        } })
                                )
                            ),
                            React.createElement(
                                'tbody',
                                null,
                                Object.values(this.props.coursePlan.competenceDomains).forEach(function (competenceDomain) {

                                    var row = new Object();
                                    row.competenceDomain = competenceDomain;
                                    row.competenceDomainSymbol = competenceDomain.symbol;
                                    row.competenceDomainName = competenceDomain.name;
                                    Object.values(competenceDomain.operationalCompetences).forEach(function (operationalCompetence) {
                                        var opComp = new Object();
                                        opComp.operationnalCompetence = operationalCompetence;
                                        opComp.symbol = operationalCompetence.symbol;
                                        opComp.name = operationalCompetence.name;
                                        row.operationnalCompetences !== undefined ? row.operationnalCompetences.push(opComp) : row.operationnalCompetences = [opComp];
                                    });
                                    _this5.tableRows.push(React.createElement(TableRow, { mobiledisplay: _this5.state.mobiledisplay, coursePlanRows: row }));
                                }),
                                this.tableRows
                            )
                        )
                    )
                );
            }
        }
    }, {
        key: 'hideMenu',
        value: function hideMenu() {
            document.getElementById('leftColumn').style.transform = 'translateX(-100%)';
            document.getElementById('opcompList').style.setProperty('padding-left', '0', 'important');
            document.getElementById('leftColumn').addEventListener('transitionend', this.closeMenuListener = function (e) {
                document.getElementById('closelbtn').style.setProperty('transform', 'translateX(0)', 'important');
            });
        }
    }, {
        key: 'showMenu',
        value: function showMenu() {
            document.getElementById('leftColumn').removeEventListener('transitionend', this.closeMenuListener);
            document.getElementById('opcompList').style.setProperty('padding-left', null);
            document.getElementById('leftColumn').style.setProperty('transform', 'translateX(0)', 'important');

            document.getElementById('closelbtn').style.setProperty('transform', null, 'important');
        }
    }]);

    return ProgressView;
}(React.Component);

var CompetenceDomainView = function (_React$Component4) {
    _inherits(CompetenceDomainView, _React$Component4);

    function CompetenceDomainView(props) {
        _classCallCheck(this, CompetenceDomainView);

        var _this6 = _possibleConstructorReturn(this, (CompetenceDomainView.__proto__ || Object.getPrototypeOf(CompetenceDomainView)).call(this, props));

        _this6.competenceDomainProgress = getCompDomainProgress(_this6.props.competenceDomainDatas);
        return _this6;
    }

    _createClass(CompetenceDomainView, [{
        key: 'render',
        value: function render() {
            var _this7 = this;

            if (this.props.mobiledisplay) {
                return React.createElement(
                    'div',
                    { className: 'compdom', onClick: function onClick() {
                            _this7.props.onClick(_this7.props.competenceDomainDatas.operationalCompetences);
                        } },
                    React.createElement(
                        'span',
                        { className: 'competenceDomainSymbol' },
                        this.props.competenceDomainSymbol
                    ),
                    React.createElement(
                        'span',
                        { className: 'competenceDomainName' },
                        this.props.competenceDomainName
                    ),
                    React.createElement(Progressbar, { colors: ['#6ca77f', '#AE9B70', '#d9af47', '#D9918D'],
                        elements: this.competenceDomainProgress,
                        timeToRefresh: '10', elementToGroup: 1, disabled: false
                    })
                );
            } else return React.createElement(
                'span',
                { style: { display: 'contents' } },
                React.createElement(
                    'td',
                    { className: 'competenceDomainSymbol', colSpan: 1 },
                    this.props.competenceDomainSymbol
                ),
                React.createElement(
                    'td',
                    { className: 'competenceDomainName', colSpan: 3 },
                    React.createElement(
                        'div',
                        { style: {
                                display: 'flex',
                                flexDirection: 'column',
                                justifyContent: 'space-between',
                                height: '100%'
                            } },
                        this.props.competenceDomainName,
                        React.createElement(Progressbar, { colors: ['#6ca77f', '#AE9B70', '#d9af47', '#D9918D'],
                            elements: this.competenceDomainProgress,
                            timeToRefresh: '10', elementToGroup: 1, disabled: false
                        })
                    )
                )
            );
        }
    }]);

    return CompetenceDomainView;
}(React.Component);

var OperationalCompetenceView = function (_React$Component5) {
    _inherits(OperationalCompetenceView, _React$Component5);

    function OperationalCompetenceView(props) {
        _classCallCheck(this, OperationalCompetenceView);

        var _this8 = _possibleConstructorReturn(this, (OperationalCompetenceView.__proto__ || Object.getPrototypeOf(OperationalCompetenceView)).call(this, props));

        _this8.operationalCompetenceProgress = getOpCompProgress(props.operationalCompetenceDatas);
        return _this8;
    }

    _createClass(OperationalCompetenceView, [{
        key: 'render',
        value: function render() {
            if (this.props.mobiledisplay) {
                return React.createElement(
                    'div',
                    { className: 'operationalCompetence' },
                    React.createElement(
                        'span',
                        { className: 'operationalCompetenceSymbol' },
                        this.props.operationalCompetenceSymbol
                    ),
                    React.createElement(
                        'span',
                        { className: 'operationalCompetenceName' },
                        this.props.operationalCompetenceName
                    ),
                    React.createElement(Progressbar, { colors: ['#6ca77f', '#AE9B70', '#d9af47', '#D9918D'],
                        elements: this.operationalCompetenceProgress,
                        timeToRefresh: '10', elementToGroup: 1, disabled: false,
                        key: this.props.operationalCompetenceDatas.id
                    })
                );
            } else {
                return React.createElement(
                    'span',
                    { style: { display: 'contents' } },
                    React.createElement(
                        'td',
                        { className: 'operationalCompetenceSymbol', colSpan: 1 },
                        this.props.operationalCompetenceSymbol
                    ),
                    React.createElement(
                        'td',
                        { className: 'operationalCompetenceName', colSpan: 2 },
                        React.createElement(
                            'div',
                            {
                                style: { display: 'flex', flexDirection: 'column', justifyContent: 'space-between', height: '100%' } },
                            this.props.operationalCompetenceName,
                            React.createElement(Progressbar, { colors: ['#6ca77f', '#AE9B70', '#d9af47', '#D9918D'],
                                elements: this.operationalCompetenceProgress,
                                timeToRefresh: '10', elementToGroup: 1, disabled: false,
                                key: this.props.operationalCompetenceDatas.id
                            })
                        )
                    )
                );
            }
        }
    }]);

    return OperationalCompetenceView;
}(React.Component);