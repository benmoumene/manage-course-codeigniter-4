class TableRow extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            operationnalCompetences: []
        }
    }

    render() {
        return (<tr>

                <CompetenceDomainView mobiledisplay={this.props.mobiledisplay}
                                      competenceDomainSymbol={this.props.coursePlanRows.competenceDomainSymbol}
                                      competenceDomainName={this.props.coursePlanRows.competenceDomainName}
                                      competenceDomainDatas={this.props.coursePlanRows.competenceDomain}/>
                {this.props.coursePlanRows.operationnalCompetences.forEach((operationalCompetence) => {
                    this.state.operationnalCompetences.push(<OperationalCompetenceView
                        mobiledisplay={this.props.mobiledisplay}
                        operationalCompetenceSymbol={operationalCompetence.symbol}
                        operationalCompetenceName={operationalCompetence.name}
                        operationalCompetenceDatas={operationalCompetence.operationnalCompetence}/>);

                })}

                {this.state.operationnalCompetences}

            </tr>
        )

    }

}
class Frame extends React.Component{

    constructor(props) {
        super(props);

    }
    componentDidMount(){


    }
    render(){
        this.list=[];
        Object.values(this.props.operationnalCompetences).forEach((opcomp)=>{
        });
        return (
            <div style={{display:'contents'}}>
                {this.list}
            </div>
        )
    }
}

class ProgressView extends React.Component {
    openMenuListener;
    closeMenuListener;
    tableRows = [];
    competenceDomains=[];
    operationalCompetences=[];
    listbtn=React.createRef();
    refreshComponent=(e) => {
        if (window.innerWidth > 950) {
            this.setState({
                mobiledisplay: false
            });

        } else {
            this.setState({
                mobiledisplay: true
            });
        }
    }

    constructor(props) {
        super(props);
        this.state = {
            mobiledisplay: window.innerWidth < 950,
            page:1
        }
        this.hideMenu=this.hideMenu.bind(this);
        this.showMenu=this.showMenu.bind(this);

    }

    componentDidMount() {
        window.innerWidth > 950 ?
            this.setState({
                mobiledisplay: false
            })
            :
            this.setState({
                mobiledisplay: true
            });

        window.addEventListener('resize',this.refreshComponent)
    }
    componentWillUnmount(){
        window.removeEventListener('resize',this.refreshComponent)
    }

    render() {
        this.competenceDomains=[];
        let intermediateList=[];
        this.tableRows=[];
        if (this.state.mobiledisplay) {
            return (
                <div id={'detailsFrame'}>
                    <div id="opcompList">
                        <div id="leftColumn">
                            <span id={'listbtn'} ref={this.listbtn} onClick={(e)=>this.hideMenu()}><i className={'bi bi-list'}></i></span>
                            {Object.values(this.props.coursePlan.competenceDomains).forEach((competenceDomain) => {
                                this.competenceDomains.push(<CompetenceDomainView mobiledisplay={true} competenceDomainDatas={competenceDomain} competenceDomainName={competenceDomain.name} competenceDomainSymbol={competenceDomain.symbol} onClick={(opcomps)=>{
                                    this.hideMenu();
                                    this.setState({page:competenceDomain.id});
                                }
                                }/>);
                                intermediateList=[];
                                Object.values(competenceDomain.operationalCompetences).forEach((operationalCompetence)=>{
                                    intermediateList.push(<OperationalCompetenceView key={operationalCompetence.id} operationalCompetenceSymbol={operationalCompetence.symbol} operationalCompetenceName={operationalCompetence.name} operationalCompetenceDatas={operationalCompetence} mobiledisplay={true}/>)
                                })
                                this.operationalCompetences[competenceDomain.id]=intermediateList;
                            })}
                            {this.competenceDomains}




                            </div>
                        <span id={'closelbtn'} onClick={(e)=>this.showMenu()}><i className={'bi bi-list'}></i></span>
                        {this.operationalCompetences[this.state.page]}
                        <i className={'bi bi-x-circle-fill'} id={'exitdetails'} onClick={() => {
                            this.props.callback();
                        }}></i>
                    </div>
                </div>
            );
        } else {
            return (

                <div id={'detailsFrame'}>
                    <div style={{display: 'flex', justifyContent: 'center', width: '90%'}}>

                        <table id={'courseplandetails'} className={"table"}
                               style={{tableLayout: 'fixed', width: '100%'}}>
                            <thead className={'table-dark bg-primary'}>
                            <tr>
                                <th style={{width: '13%'}}>competence domain</th>
                                <th colSpan={21}>operational competences</th>
                                <i className={'bi bi-x-circle-fill'} id={'exitdetails'} onClick={() => {
                                    this.props.callback();
                                }}></i>

                            </tr>
                            </thead>
                            <tbody>
                            {Object.values(this.props.coursePlan.competenceDomains).forEach((competenceDomain) => {

                                let row = new Object();
                                row.competenceDomain = competenceDomain;
                                row.competenceDomainSymbol = competenceDomain.symbol;
                                row.competenceDomainName = competenceDomain.name;
                                Object.values(competenceDomain.operationalCompetences).forEach((operationalCompetence) => {
                                    let opComp = new Object();
                                    opComp.operationnalCompetence = operationalCompetence;
                                    opComp.symbol = operationalCompetence.symbol;
                                    opComp.name = operationalCompetence.name;
                                    row.operationnalCompetences !== undefined ? row.operationnalCompetences.push(opComp) : row.operationnalCompetences = [opComp];
                                })
                                this.tableRows.push(<TableRow mobiledisplay={this.state.mobiledisplay} coursePlanRows={row}/>);

                            })
                            }
                            {this.tableRows}


                            </tbody>

                        </table>
                    </div>
                </div>


            );
        }
    }
    hideMenu(){
        document.getElementById('leftColumn').style.transform='translateX(-100%)';
        document.getElementById('opcompList').style.setProperty('padding-left','0','important')
        document.getElementById('leftColumn').addEventListener('transitionend',this.closeMenuListener=(e)=>{
            document.getElementById('closelbtn').style.setProperty('transform','translateX(0)','important')


        })
    }
    showMenu(){
        document.getElementById('leftColumn').removeEventListener('transitionend',this.closeMenuListener);
        document.getElementById('opcompList').style.setProperty('padding-left',null)
        document.getElementById('leftColumn').style.setProperty('transform','translateX(0)','important')

        document.getElementById('closelbtn').style.setProperty('transform',null,'important');
    }

}

class CompetenceDomainView extends React.Component {
    competenceDomainProgress;

    constructor(props) {
        super(props);
        this.competenceDomainProgress = getCompDomainProgress(this.props.competenceDomainDatas);
    }

    render() {
        if (this.props.mobiledisplay){
            return(
                <div className="compdom" onClick={()=>{
                    this.props.onClick(this.props.competenceDomainDatas.operationalCompetences)
                }}>
                    <span className="competenceDomainSymbol">{this.props.competenceDomainSymbol}</span>
                    <span className="competenceDomainName">{this.props.competenceDomainName}</span>
                    <Progressbar colors={['#6ca77f', '#AE9B70', '#d9af47', '#D9918D']}
                                 elements={this.competenceDomainProgress}
                                 timeToRefresh="10" elementToGroup={1} disabled={false}
                    />
                </div>
            )
        }
        else
        return (
            <span style={{display: 'contents'}}>
                <td className="competenceDomainSymbol" colSpan={1}>{this.props.competenceDomainSymbol}</td>
                <td className="competenceDomainName" colSpan={3}><div style={{
                    display: 'flex',
                    flexDirection: 'column',
                    justifyContent: 'space-between',
                    height: '100%'
                }}>{this.props.competenceDomainName}
                    <Progressbar colors={['#6ca77f', '#AE9B70', '#d9af47', '#D9918D']}
                                 elements={this.competenceDomainProgress}
                                 timeToRefresh="10" elementToGroup={1} disabled={false}
                    />
                </div></td>
                </span>
        );
    }

}

class OperationalCompetenceView extends React.Component {
    operationalCompetenceProgress;

    constructor(props) {
        super(props);
        this.operationalCompetenceProgress = getOpCompProgress(props.operationalCompetenceDatas);
    }

    render() {
        if (this.props.mobiledisplay) {
            return (
                <div className="operationalCompetence">
                    <span className="operationalCompetenceSymbol">{this.props.operationalCompetenceSymbol}</span>
                    <span className="operationalCompetenceName">{this.props.operationalCompetenceName}</span>
                    <Progressbar colors={['#6ca77f', '#AE9B70', '#d9af47', '#D9918D']}
                                 elements={this.operationalCompetenceProgress}
                                 timeToRefresh="10" elementToGroup={1} disabled={false}
                                 key={this.props.operationalCompetenceDatas.id}
                    />
                </div>
            )
        } else {
            return (
                <span style={{display: 'contents'}}>
            <td className="operationalCompetenceSymbol" colSpan={1}>{this.props.operationalCompetenceSymbol}</td>
            <td className="operationalCompetenceName" colSpan={2}>
                <div
                    style={{display: 'flex', flexDirection: 'column', justifyContent: 'space-between', height: '100%'}}>
                    {this.props.operationalCompetenceName}
                    <Progressbar colors={['#6ca77f', '#AE9B70', '#d9af47', '#D9918D']}
                                 elements={this.operationalCompetenceProgress}
                                 timeToRefresh="10" elementToGroup={1} disabled={false}
                                 key={this.props.operationalCompetenceDatas.id}
                    />
                </div></td>
            </span>
            )
        }
    }
}


