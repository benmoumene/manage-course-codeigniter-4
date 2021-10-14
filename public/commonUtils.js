function getCoursePlanProgress(coursePlan){
    const unitCounter=[0,0,0,0];
    const courseplanStatus=coursePlan.fk_acquisition_status;
    Object.values(coursePlan.competenceDomains).forEach((competenceDomain)=>{
        Object.values(competenceDomain.operationalCompetences).forEach((operationalCompetence)=>{
            Object.values(operationalCompetence.objectives).forEach((objective)=>{
                switch (objective.fk_acquisition_level){
                    case '1':
                        unitCounter[3]===0?unitCounter[3]=1:unitCounter[3]++
                        break;
                    case '2':
                        unitCounter[2]===0?unitCounter[2]=1:unitCounter[2]++
                        break;
                    case '3':
                        unitCounter[1]===0?unitCounter[1]=1:unitCounter[1]++
                        break;
                    default:
                        unitCounter[0]===0?unitCounter[0]=1:unitCounter[0]++

                }
            })
        })

    });
    let coursePlanStats={
        status:courseplanStatus,
        progress:unitCounter
    };
    return coursePlanStats;
}
function getCompDomainProgress(competenceDomain){
    const unitCounter=[0,0,0,0];

    Object.values(competenceDomain.operationalCompetences).forEach((operationalCompetence)=>{
        Object.values(operationalCompetence.objectives).forEach((objective)=>{
            switch (objective.fk_acquisition_level){
                case '1':
                    unitCounter[3]===0?unitCounter[3]=1:unitCounter[3]++
                    break;
                case '2':
                    unitCounter[2]===0?unitCounter[2]=1:unitCounter[2]++
                    break;
                case '3':
                    unitCounter[1]===0?unitCounter[1]=1:unitCounter[1]++
                    break;
                default:
                    unitCounter[0]===0?unitCounter[0]=1:unitCounter[0]++

            }
        })
})
    return unitCounter;
}
function getOpCompProgress(operationalCompetence){
    const unitCounter=[0,0,0,0];
    Object.values(operationalCompetence.objectives).forEach((objective)=>{
        switch (objective.fk_acquisition_level){
            case '1':
                unitCounter[3]===0?unitCounter[3]=1:unitCounter[3]++
                break;
            case '2':
                unitCounter[2]===0?unitCounter[2]=1:unitCounter[2]++
                break;
            case '3':
                unitCounter[1]===0?unitCounter[1]=1:unitCounter[1]++
                break;
            default:
                unitCounter[0]===0?unitCounter[0]=1:unitCounter[0]++

        }
    })
    return unitCounter;
}