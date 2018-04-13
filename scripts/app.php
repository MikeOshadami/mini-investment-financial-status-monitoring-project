<?php
function countFinancialStatementForPeriod($db_con, $companyId, $userId, $monthId,$year){
    $sql = "SELECT count(*) FROM financialinformation WHERE company_id = :company_id and month_id=:month_id and year_id =:year_id";
    $result = $db_con->prepare($sql);
    $result->execute(array(":company_id"=>$companyId, ":month_id"=>$monthId, ":year_id"=>$year));
    $number_of_rows = $result->fetchColumn();
    return $number_of_rows;
}

function enterFinancialStatement($db_con, $companyId, $userId, $grossIncome, $operatingCost, $adminExpenses, $marketingExpenses, $depreciation, $otherCharges, $incomeTax, $currentMonthId, $currentYear)
{
    //We start our transaction.
    $db_con->beginTransaction();
    try {
        $approverId = getNextApprover($db_con, $companyId);
        $grossProfitLoss = calculateGross($grossIncome, $operatingCost);
        $eBITDA = calculateEBITDA($grossProfitLoss, $adminExpenses, $marketingExpenses);
        $pbt = calculatePbt($eBITDA, $depreciation, $otherCharges);
        $pat = calculatePat($pbt, $incomeTax);
        $sql = "INSERT INTO financialinformation (company_id, user_id, grossIncome, operatingCost, adminExpenses, marketingExpenses, depreciation, otherCharges, incomeTax, grossProfitLoss, eBITDA, pbt, pat,year_id, month_id, approver_id, transactiondate) VALUES (?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?,?, ?, ?, ?, ?, Now())";
        $stmt = $db_con->prepare($sql);
        $stmt->execute(array(
                $companyId,
                $userId,
                $grossIncome,
                $operatingCost,
                $adminExpenses,
                $marketingExpenses,
                $depreciation,
                $otherCharges,
                $incomeTax,
                $grossProfitLoss,
                $eBITDA,
                $pbt,
                $pat,
                $currentYear,
                $currentMonthId,
                $approverId
            )
        );

        $db_con->commit();
    } //Our catch block will handle any exceptions that are thrown.
    catch (Exception $e) {
        //Print out the error message.
        echo $e->getMessage();
        //Rollback the transaction.

    }
}
    function getNextApprover ($db_con, $companyId){
        $stmt = $db_con->prepare("SELECT * FROM approvers WHERE company_id=:companyId");
        $stmt->execute(array(":companyId"=>$companyId));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $userId = $row['user_id'];
        return $userId;
    }

    function getFinancialStatementByCompanyId ($db_con, $companyId){
        $sql = "SELECT * FROM financialinformation f left join monthlyconfig m on f.month_id=m.id WHERE company_id = :company_id and status='A'";
        $result = $db_con->prepare($sql);
        $result->execute(array(":company_id"=>$companyId));
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

function getAllPendingFinancialStatement($db_con, $companyId, $userId){
    $sql = "SELECT f.id, fname,lname,transactiondate,month_name FROM financialinformation f left join monthlyconfig m on f.month_id=m.id left join users u on f.user_id=u.id WHERE f.company_id = :company_id and approver_id = :approverId and status='P'";
    $result = $db_con->prepare($sql);
    $result->execute(array(":company_id"=>$companyId, ":approverId"=>$userId));
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

    function getPendingFinancialStatement($db_con, $companyId, $userId, $reportId){
        $sql = "SELECT * FROM financialinformation f left join monthlyconfig m on f.month_id=m.id WHERE company_id = :company_id and f.id = :reportId and approver_id = :approverId and status='P'";
        $result = $db_con->prepare($sql);
        $result->execute(array(":company_id"=>$companyId, ":reportId"=>$reportId, ":approverId"=>$userId));
        $rows = $result->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

function calculateGross($grossIncome, $operatingCost){
    return (double)$grossIncome - (double)$operatingCost;
}

function calculateEBITDA($grossProfitLoss, $adminExpenses, $marketingExpenses){
    return (double)$grossProfitLoss - ((double)$adminExpenses + (double)$marketingExpenses);
}

function calculatePbt($eBITDA, $depreciation, $otherCharges){
    return (double)$eBITDA - ((double)$depreciation + (double)$otherCharges);
}

function calculatePat($pbt, $incomeTax){
    return (double)$pbt - (double)$incomeTax;
}
    function approveFinancialStatement($db_con, $grossIncome, $operatingCost, $adminExpenses, $marketingExpenses, $depreciation, $otherCharges, $incomeTax, $reportId){
        $grossProfitLoss = calculateGross($grossIncome, $operatingCost);
        $eBITDA = calculateEBITDA($grossProfitLoss, $adminExpenses, $marketingExpenses);
        $pbt = calculatePbt($eBITDA, $depreciation, $otherCharges);
        $pat = calculatePat($pbt, $incomeTax);
        $sql = "UPDATE financialinformation SET grossIncome = ?, operatingCost = ?, adminExpenses = ?, marketingExpenses = ?, depreciation = ?, otherCharges = ?, incomeTax = ?, grossProfitLoss = ?, eBITDA = ?, pbt = ?, pat = ?, status = ? where id = ?";
        $stmt = $db_con->prepare($sql);
        $stmt->execute(array(
            $grossIncome,
            $operatingCost,
            $adminExpenses,
            $marketingExpenses,
            $depreciation,
            $otherCharges,
            $incomeTax,
            $grossProfitLoss,
            $eBITDA,
            $pbt,
            $pat,
            "A",
            $reportId
        ));


    }

