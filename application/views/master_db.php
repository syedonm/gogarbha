<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class master_db extends CI_Model{

		
		function sqlExecute($sql)
	{
	    $q=$this->db->query($sql);
	    return $q !== FALSE ? $q->result() : array();
	}
	
	    function getRecords($table,$db = array(),$select = "*",$ordercol = '',$group = '',$start='',$limit='')
    {
        $this->db->select($select);
        if(!empty($ordercol))
        {
            $this->db->order_by($ordercol);
        }
        if($limit != '' && $start !='')
        {
            $this->db->limit($limit,$start);
        }
        if($group != '')
        {
            $this->db->group_by($group);
        }
        $q=$this->db->get_where($table, $db);
        return $q !== FALSE ? $q->result() : array();
        //return $q->result();
        //return $this->db->last_query();
    }
		
		function gettable_orderno($table,$db=array())
		{
            $page = $db['page'];

            $rp = $db['rp'];

            $sortname = $db['sortname'];

            $sortorder = $db['sortorder'];

            

            if($db['query']!=''){

            $where = ' WHERE   '.$db['qtype'].' LIKE "%'.$db['query'].'%"';

            } else {

            $where ='';

            }

            if($db['letter_pressed']!=''){

            $where = ' WHERE   '.$db['qtype'].' LIKE "'.$db['letter_pressed'].'%"';    

            }

            if($db['letter_pressed']=='#'){

            $where = ' WHERE   '.$db['qtype'].' REGEXP "[[:digit:]]" ';

            }

            $sort = "ORDER BY id $sortorder";

            

            if (!$page) $page = 1;

            if (!$rp) $rp = 10;

            

            $start = (($page-1) * $rp);

            

            $limit = "LIMIT $start, $rp";

            

            $sql = "SELECT * FROM  $table $where $sort $limit";

            

            

            $result = $this->db->query($sql);

            $tempsql=" ".$table." ".$where." ".$sort." ".$limit;

            

            $total = $this->countRec('id',$table,$where);

            

            header("Content-type: application/json");



            $json = '';

            $json .= '{';

            $json .= '"page": '.$page.',';

            $json .= '"total": '.$total.',';

            $json .= '"rows": [';

            $rc = false;

            $counter123=1;

            

            foreach($result->result() as $row) {

            

            if($row->status=='0')

            {

            $status="<span class='btn btn-success btn-sm btn-grad'>Active</span>";

            $chng="<button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";

            }

            else

            {

            $status="<span class='btn btn-danger btn-sm btn-grad'>In-Active</span>";

            $chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";

            }

            $edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$row->id.")'><i class='icon-pencil icon-white'></i> Edit </button>";

            $finalquery=str_replace(" ","~",$tempsql);

            if ($rc) $json .= ',';

            $json .= '{';

            $json .= '"id":"'.$row->id.'","';

            $json .= 'cell":["'.$counter123.'","'.$row->order_no.'","'.addslashes(str_replace("'","`",$row->name)).'"';

            $json .= ',"'.$status.'","'.$chng.'&nbsp;'.$edit.'"]';

   
            $json .= "}";

            $rc = true;
         

            $counter123++;

            }

            $json .= "]";

            $json .= "}";

            return $json;

    }

    function gettable_category($table,$db=array())
    {
        $page = $db['page'];

        $rp = $db['rp'];

        $sortname = $db['sortname'];

        $sortorder = $db['sortorder'];



        if($db['query']!=''){

            $where = ' WHERE   '.$db['qtype'].' LIKE "%'.$db['query'].'%"';

        } else {

            $where ='';

        }

        if($db['letter_pressed']!=''){

            $where = ' WHERE   '.$db['qtype'].' LIKE "'.$db['letter_pressed'].'%"';

        }

        if($db['letter_pressed']=='#'){

            $where = ' WHERE   '.$db['qtype'].' REGEXP "[[:digit:]]" ';

        }

        $sort = "ORDER BY id $sortorder";



        if (!$page) $page = 1;

        if (!$rp) $rp = 10;



        $start = (($page-1) * $rp);



        $limit = "LIMIT $start, $rp";



        $sql = "SELECT * FROM  $table $where $sort $limit";





        $result = $this->db->query($sql);

        $tempsql=" ".$table." ".$where." ".$sort." ".$limit;



        $total = $this->countRec('id',$table,$where);



        header("Content-type: application/json");



        $json = '';

        $json .= '{';

        $json .= '"page": '.$page.',';

        $json .= '"total": '.$total.',';

        $json .= '"rows": [';

        $rc = false;

        $counter123=1;



        foreach($result->result() as $row) {



            if($row->status=='0')

            {

                $status="<span class='btn btn-success btn-sm btn-grad'>Active</span>";

                $chng="<button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";

            }

            else

            {

                $status="<span class='btn btn-danger btn-sm btn-grad'>In-Active</span>";

                $chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";

            }

            $edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$row->id.")'><i class='icon-pencil icon-white'></i> Edit </button>";
            $image="<img src='".str_replace(base_url())."".$row->image_path."' width='110px'>";
            $finalquery=str_replace(" ","~",$tempsql);

            if ($rc) $json .= ',';

            $json .= '{';

            $json .= '"id":"'.$row->id.'","';

            $json .= 'cell":["'.$counter123.'","'.$row->order_no.'","'.addslashes(str_replace("'","`",$row->name)).'","'.addslashes(str_replace("'","`",$row->short_form)).'","'.$image.'"';

            $json .= ',"'.$status.'","'.$chng.'&nbsp;'.$edit.'"]';


            $json .= "}";

            $rc = true;


            $counter123++;

        }

        $json .= "]";

        $json .= "}";

        return $json;

    }
    
    
    function gettable($table,$db=array())
    {
    	$page = $db['page'];
    
    	$rp = $db['rp'];
    
    	$sortname = $db['sortname'];
    
    	$sortorder = $db['sortorder'];
    
    
    
    	if($db['query']!=''){
    
    		$where = ' WHERE   '.$db['qtype'].' LIKE "%'.$db['query'].'%"';
    
    	} else {
    
    		$where ='';
    
    	}
    
    	if($db['letter_pressed']!=''){
    
    		$where = ' WHERE   '.$db['qtype'].' LIKE "'.$db['letter_pressed'].'%"';
    
    	}
    
    	if($db['letter_pressed']=='#'){
    
    		$where = ' WHERE   '.$db['qtype'].' REGEXP "[[:digit:]]" ';
    
    	}
    
    	$sort = "ORDER BY id $sortorder";
    
    
    
    	if (!$page) $page = 1;
    
    	if (!$rp) $rp = 10;
    
    
    
    	$start = (($page-1) * $rp);
    
    
    
    	$limit = "LIMIT $start, $rp";
    
    
    
    	$sql = "SELECT * FROM  $table $where $sort $limit";
    
    
    
    
    
    	$result = $this->db->query($sql);
    
    	$tempsql=" ".$table." ".$where." ".$sort." ".$limit;
    
    
    
    	$total = $this->countRec('id',$table,$where);
    
    
    
    	header("Content-type: application/json");
    
    
    
    	$json = '';
    
    	$json .= '{';
    
    	$json .= '"page": '.$page.',';
    
    	$json .= '"total": '.$total.',';
    
    	$json .= '"rows": [';
    
    	$rc = false;
    
    	$counter123=1;
    
    
    
    	foreach($result->result() as $row) {
    
    
    
    		if($row->status=='0')
    
    		{
    
    			$status="<span class='btn btn-success btn-sm btn-grad'>Active</span>";
    
    			$chng="<button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";
    
    		}
    
    		else
    
    		{
    
    			$status="<span class='btn btn-danger btn-sm btn-grad'>In-Active</span>";
    
    			$chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";
    
    		}
    
    		$edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$row->id.")'><i class='icon-pencil icon-white'></i> Edit </button>";
    
    		$finalquery=str_replace(" ","~",$tempsql);
    
    		if ($rc) $json .= ',';
    
    		$json .= '{';
    
    		$json .= '"id":"'.$row->id.'","';
    
    		$json .= 'cell":["'.$counter123.'","'.addslashes(str_replace("'","`",$row->name)).'"';
    
    		$json .= ',"'.$status.'","'.$chng.' '.$edit.'"]';
    
    		 
    		$json .= "}";
    
    		$rc = true;
    		 
    
    		$counter123++;
    
    	}
    
    	$json .= "]";
    
    	$json .= "}";
    
    	return $json;
    
    }
    
    function runQuery($sql){
    	//echo $sql;
    	$this->db->query($sql);
    }
    
    
    public function create_unique_slug($string,$table,$field,$key=NULL,$value=NULL)
    {
    	$t =& get_instance();
    	$slug = url_title($string);
    	$slug = strtolower($slug);
    	$i = 0;
    	$params = array ();
    	$params[$field] = $slug;
    
    	if($key)$params["$key !="] = $value;
    
    	while ($t->db->where($params)->get($table)->num_rows())
    	{
    		if (!preg_match ('/-{1}[0-9]+$/', $slug ))
    			$slug .= '-' . ++$i;
    		else
    			$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
    		 
    		$params [$field] = $slug;
    	}
    	return $slug;
    }
    
	function countRec($fname,$tname,$where)

    {

        $sql = "SELECT * FROM $tname $where";

        $q=$this->db->query($sql);

        return $q->num_rows();

    }
    
    function runsql($fname,$tname,$where){
    	$sql = "SELECT * FROM $tname $where";
    	
    	$q=$this->db->query($sql);
    	
    	if($q->num_rows()>0)
	
			return $q->result();
	
		else
	
			return 0;
    }
	
	function insertRecord($table,$db=array())

    {

        $q=$this->db->insert($table, $db); 

        $total = $this->db->insert_id();

        if($total>0)

        return $total;

        else 

        return 0;

    }
	
	
	function getcontent($table,$id)
	{

		if(!empty($id)){
	    $this->db->where('id',$id);
		}

        $q=$this->db->get($table);

        if($q->num_rows()>0)

        return $q->result();

        else

        return 0;

	}

	function getcontent1($table,$col,$id)
	{
	
		if(!empty($id)){
			$this->db->where($col,$id);
		}
	
		$q=$this->db->get($table);
	
		if($q->num_rows()>0)
	
			return $q->result();
	
		else
	
			return 0;
	
	}
	
	function getcontent2($table,$col,$id,$status)
	{
	
		if(!empty($id)){
			$this->db->where($col,$id);
		}
		if($status != ''){
			$this->db->where('status',$status);
		}
	
		$q=$this->db->get($table);
	
		if($q->num_rows()>0)
	
			return $q->result();
	
		else
	
			return 0;
	
	}
	
	
	
	function updateRecord($table,$db,$id)
	{
		$this->db->where('id',$id);
		$q=$this->db->update($table,$db); 
		$total = $this->db->affected_rows();
		if($total>0)
		return 1;
		else 
		return 0;
	}
	
	function updateRecord1($table,$db,$col,$id)
	{
		$this->db->where($col,$id);
		$q=$this->db->update($table,$db);
		$total = $this->db->affected_rows();
		if($total>0)
			return 1;
		else
			return 0;
	}
	
	function changeStatus($table,$db=array())

	{
		$sql="update $table set status=".$db['status']." WHERE id IN ('".$db['items']."')";
        $q=$this->db->query($sql);
        return 1;
		/*$sql="update $table set status=".$db['status']." WHERE id IN ('".$db['items']."')";
        $q=$this->db->query($sql); 
        $total = count(explode(",",$db['items'])); 
        $total = $this->db->affected_rows();
        header("Content-type: application/json");
        $json = "";
        $json .= "{";
        $json .= '"query": "'.$sql.'",';
        $json .= '"total": "'.$total.'"';
        $json .= "}";
        return $json;*/

	}
	function new_collection_status($table,$db=array())
	{
		$sql="update $table set new_collection=".$db['new_collection']." WHERE id IN ('".$db['items']."')";
        $q=$this->db->query($sql);
        return 1;
	}
	
	
	function dup_check($table,$name,$id)
	{
		$qry = "";
		if(!empty($id)){
			$qry = " and id!=$id";
		}
		$query = $this->db->query("Select * from $table where name='".mysql_real_escape_string($name)."' $qry");
		if($query->num_rows()>0)
			return 1;
		else
			return 0;
	}


    function dup_check_pincode($table,$name,$id)
    {
        $qry = "";
        if(!empty($id)){
            $qry = " and id!=$id";
        }
        $query = $this->db->query("Select * from $table where pincode='".mysql_real_escape_string($name)."' $qry");
        if($query->num_rows()>0)
            return 1;
        else
            return 0;
    }


	/*function deleterecord($table,$col,$id,$status)
	{
		if(!empty($status)){
			$query = $this->db->query("delete from $table where $col ='".$id."' and status=$status");
		}
		else{
			$query = $this->db->query("delete from $table where $col ='".$id."'");
		}
		
	}*/
	function deleterecord($table,$db=array())
	{
		$this->db->delete($table, $db);
	}
	
	function deleterecordwithimag($table,$col,$id,$imgcol,$imgcol1,$status){
		$category = $this->getcontent2($table,$col,$id,'1');
		if(is_array($category)){
			foreach ($category as $c){
				if(!empty($imgcol)){
					unlink('../'.$c->$imgcol);
				}
				if(!empty($imgcol1)){
					unlink('../'.$c->$imgcol1);
				}
			}
		}
		$query = $this->db->query("delete from $table where $col ='".$id."' and status=$status");
	}
	
	function getproduct($db=array()){
		$category = $this->getcontent2('category','id',$db['category'],'');
		if(is_array($category)){
		$page = $db['page'];
		
		$rp = $db['rp'];
		
		$sortname = $db['sortname'];
		
		$sortorder = $db['sortorder'];
		
		$ordernuberquery="";
		
		if(!empty($db['category']))
		{
			$ordernuberquery.=" and cid='".$db['category']."'";
		}
		
		if($db['vase']=='0' || $db['vase']=='1')
		{
			$ordernuberquery.=" and vase='".$db['vase']."'";
		}
		
		if(!empty($db['name']))
		{
			$ordernuberquery.=" and pname like '%".$db['name']."%' ";
		}
		
		if($db['stat']=='0' || $db['stat']=='1')
		{
			$ordernuberquery.=" and pstatus='".$db['stat']."' ";
		}

            if($db['stat2']=='0' || $db['stat2']=='1')
            {
                $ordernuberquery.=" and home_page='".$db['stat2']."' ";
            }
            
           /* if($db['stockstatus']=='0')
            {
            	$ordernuberquery.=" and stock <= 5";
            }
            else if($db['stockstatus']=='1'){
            	$ordernuberquery.=" and stock > 5";
            }*/
		/*
		if(!empty($db['material']))
		{
			$ordernuberquery.=" and mid = '".$db['material']."' ";
		}
		
		if(is_array($db['color']) && count($db['color'])>0)
		{
			$ordernuberquery.=" and clid IN ( ".implode(",",$db['color']).") ";
		}*/
		
		if(is_array($db['size']) && count($db['size'])>0)
		{
			$ordernuberquery.=" and size_id IN ( ".implode(",",$db['size']).") ";
		}
		
		
		if (!$sortname) $sortname = 'pcreated_date';
		
		if (!$sortorder) $sortorder = 'ASC';
		
		if($db['query']!=''){
		
			$where = ' WHERE 1  '.$ordernuberquery.' and  '.$db['qtype'].' LIKE "%'.$db['query'].'%"';
		}
		else {
		
			$where =' WHERE 1  '.$ordernuberquery.' ';
		}
		
		$sort = "group by ppid ORDER BY $sortname $sortorder";
		
		if (!$page) $page = 1;
		
		if (!$rp) $rp = 10;
		
		$start = (($page-1) * $rp);
		
		$limit = "LIMIT $start, $rp";
		
		//without limit
		if(!empty($db['category'])){
			$sql = "SELECT home_page,pname,pid ppid, cname, image_path, vase, pstatus, pcreated_date, clname, cpage_url, pcode FROM  ".$category[0]->page_url."_product_view $where $sort ";
		}
		else{
			if(is_array($category)){
				$tabarr = array(); 
				foreach ($category as $c){
					$sql = "SELECT home_page,pname,pid ppid, cname, image_path, vase, pstatus, pcreated_date,  clname, cpage_url, pcode FROM  ".$c->page_url."_product_view $where ";
					$tabarr[] = $sql;
				}
				$sql = implode(" union ", $tabarr);
				$sql = $sql." $sort";
			}
			
		}
				//echo $sql;exit;
				//$result = $this->db->query($sql);
				//print_r($result);
				//$total = count($result->result());
				//echo "without limit";
				//without limit
		
				//with limit
		
				//$sql = $sql." $limit";
				//echo $sql;exit;
				$q=$this->master_db->sqlExecute($sql);
				return $q;
				//echo $sql;
				//echo "with limit";
				//$result = $this->db->query($sql);
		
				//with limit
		
				/*header("Content-type: application/json");
		
		
		
		$json = '';
		
				$json .= '{';
		
				$json .= '"page": '.$page.',';
		
				$json .= '"total": '.$total.',';
		
				$json .= '"rows": [';
		
				$rc = false;
		
				$counter123=1;	
				$arr = array("No","Yes");
				foreach($result->result() as $row) {


                    if($row->home_page == 0){
                        $show = "<button class='btn btn-success btn-sm btn-grad' onclick='changestatus2(1,".$row->ppid.")'><i class='icon-ok'></i> Show In Home Page </button>";
                    } else {

                        $show="<button class='btn btn-danger btn-sm btn-grad' onclick='changestatus2(0,".$row->ppid.")'><i class='icon-remove'></i> Dont Show In Home Page </button>";

                    }


					if($row->pstatus=='0')
		            {
			            $status="<span class='btn btn-success btn-sm btn-grad'>Active</span>";
			            $chng="<button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->ppid.")'><i class='icon-remove'></i> Deactivate </button>";

		            }
		            else
		            {
			            $status="<span class='btn btn-danger btn-sm btn-grad'>In-Active</span>";
			            $chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->ppid.")'><i class='icon-ok'></i> Activate </button>";
		            }
		
					$image="<img src='".front_url()."".$row->image_path."' width='100px'>";	
					$size = "";
					$viewtable = $this->runsql('*',$row->cpage_url.'_product_view','where pid='.$row->ppid.'');
					
					if(is_array($viewtable)){
						$sizearr = array();
						foreach ($viewtable as $v){
							if($v->size_id == '0'){
								$sizearr[$v->sid] = 'No Size';
							}
							else{
								$sizearr[$v->sid] = $v->sname;
							}
						}
						$size = implode("<br>",$sizearr);
					}
					
					$edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$row->ppid.",`".$row->cpage_url."`)'><i class='icon-pencil icon-white'></i> Edit</button>";		
					
					if ($rc) $json .= ',';
		
					$json .= '{';
						
					$json .= '"id":"'.$row->ppid.'","';
					$json .= 'cell":["'.$counter123.'","'.$status.'","'.$chng.' '.$edit.'<br><br>'.$show.'","'.addslashes(str_replace("'","`",$row->cname)).'","'.addslashes(str_replace("'","`",$row->pname)).'","'.addslashes(str_replace("'","`",$row->pcode)).'","'.$image.'","'.addslashes($row->mname).'"';
					$json .= ',"'.addslashes($row->clname).'","'.addslashes(str_replace("'","`",$size)).'"]';
					$json .= "}";
		
					$rc = true;
		
					$counter123++;
		
				}
		
				$json .= "]";
		
				$json .= "}";
		
		
				return $json;
		}*/
		//return "iiii";
}}
			

    function getNewsTable($table,$db=array())
    {
        $page = $db['page'];

        $rp = $db['rp'];

        $sortname = $db['sortname'];

        $sortorder = $db['sortorder'];





        $sort = "ORDER BY id $sortorder";



        if (!$page) $page = 1;

        if (!$rp) $rp = 10;



        $start = (($page-1) * $rp);



        $limit = "LIMIT $start, $rp";

        $where = "";



        $sql = "SELECT * FROM  $table $where $sort $limit";





        $result = $this->db->query($sql);

        $tempsql=" ".$table." ".$where." ".$sort." ".$limit;



        $total = $this->countRec('id',$table,$where);



        header("Content-type: application/json");



        $json = '';

        $json .= '{';

        $json .= '"page": '.$page.',';

        $json .= '"total": '.$total.',';

        $json .= '"rows": [';

        $rc = false;

        $counter123=1;



        foreach($result->result() as $row) {




            if ($rc) $json .= ',';

            $json .= '{';

            $json .= '"id":"'.$row->id.'","';

            $json .= 'cell":["'.$counter123.'","'.addslashes(str_replace("'","`",$row->email)).'"';

            $json .= ','.'"'.addslashes(str_replace("'","`",date_format(date_create($row->subscribed_date), 'd-m-Y g:i A'))).'"'.' ]';


            $json .= "}";

            $rc = true;


            $counter123++;

        }

        $json .= "]";

        $json .= "}";

        return $json;

    }


    function getPincldeTable($table,$db=array())
    {
        $page = $db['page'];

        $rp = $db['rp'];

        $sortname = $db['sortname'];

        $sortorder = $db['sortorder'];

        $sort = "ORDER BY id $sortorder";

        if (!$page) $page = 1;

        if (!$rp) $rp = 10;

        $start = (($page-1) * $rp);

        $limit = "LIMIT $start, $rp";

        $where = "";

        $sql = "SELECT * FROM  $table $where $sort $limit";

        $result = $this->db->query($sql);

        $tempsql=" ".$table." ".$where." ".$sort." ".$limit;

        $total = $this->countRec('id',$table,$where);

        header("Content-type: application/json");

        $json = '';

        $json .= '{';

        $json .= '"page": '.$page.',';

        $json .= '"total": '.$total.',';

        $json .= '"rows": [';

        $rc = false;

        $counter123=1;



        foreach($result->result() as $row) {




            if ($rc) $json .= ',';

            $json .= '{';

            $json .= '"id":"'.$row->id.'","';

            $json .= 'cell":["'.$counter123.'","'.addslashes(str_replace("'","`",$row->pincode)).'","'.addslashes(str_replace("'","`",$row->charges)).'"';

            $edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$row->id.")'><i class='icon-pencil icon-white'></i> Edit </button>";

            $json .= ','.'"'.$edit.'"'.' ]';


            $json .= "}";

            $rc = true;


            $counter123++;

        }

        $json .= "]";

        $json .= "}";

        return $json;

    }


    function deletePins($pins){

        $table = "pincodes";

        $sql = "delete  from $table  WHERE id IN ($pins)";

        $q = $this->db->query($sql);
        $num  = $this->db->affected_rows();
        header("Content-type: application/json");

        $json = "";

        $json .= "{";

        $json .= '"query": "'.$sql.'",';

        $json .= '"total": "'.$num.'"';

        $json .= "}";

        return $json;
    }




    function addtoPins($pins){

        $table = "pincodes";



        $sql = "INSERT INTO  $table(`pincode`)  select pincode from failedpincode where id in($pins)";

        $q = $this->db->query($sql);
        $num  = $this->db->affected_rows();

        $table = "failedpincode";

        $sql = "delete  from $table  WHERE id IN ($pins)";

        $q = $this->db->query($sql);
        $num  = $this->db->affected_rows();


        header("Content-type: application/json");

        $json = "";

        $json .= "{";

        $json .= '"query": "'.$sql.'",';

        $json .= '"total": "'.$num.'"';

        $json .= "}";

        return $json;
    }












    function addPinsFromCsv($data){
        $sql123="INSERT into pincodes (pincode)  values('".mysql_real_escape_string($data)."')";
        $q = $this->db->query($sql123);
        $num  = $q->num_rows();
        if($num>0){
            return 1;
        }else{
            return 0;
        }
    }


    function gettable_city($db=array())
    {
        $table = "states s,cities c";
        $page = $db['page'];

        $rp = $db['rp'];

        $sortname = $db['sortname'];

        $sortorder = $db['sortorder'];



        if($db['query']!=''){

            $where = ' WHERE  s.id=c.state_id and '.$db['qtype'].' LIKE "%'.$db['query'].'%"';

        } else {

            $where =' where s.id=c.state_id';

        }

        if($db['letter_pressed']!=''){

            $where = ' WHERE  s.id=c.state_id and '.$db['qtype'].' LIKE "'.$db['letter_pressed'].'%"';

        }

        if($db['letter_pressed']=='#'){

            $where = ' WHERE s.id=c.state_id and '.$db['qtype'].' REGEXP "[[:digit:]]" ';

        }


        if($sortorder != "" || $sortname != ""){
        $sort = "ORDER BY $sortname $sortorder";
        } else{
            $sort = "";
        }




        if (!$page) $page = 1;

        if (!$rp) $rp = 10;



        $start = (($page-1) * $rp);



        $limit = "LIMIT $start, $rp";



        $sql = "SELECT c.*,s.name as sname FROM  $table $where $sort $limit";





        $result = $this->db->query($sql);

        $tempsql=" ".$table." ".$where." ".$sort." ".$limit;



        $total = $this->countRec('c.id',$table,$where);



        header("Content-type: application/json");



        $json = '';

        $json .= '{';

        $json .= '"page": '.$page.',';

        $json .= '"total": '.$total.',';

        $json .= '"rows": [';

        $rc = false;

        $counter123=1;



        foreach($result->result() as $row) {



            if($row->status=='0')

            {

                $status="<span class='btn btn-success btn-sm btn-grad'>Active</span>";

                $chng="<button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";

            }

            else

            {

                $status="<span class='btn btn-danger btn-sm btn-grad'>In-Active</span>";

                $chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";

            }

            $edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$row->id.")'><i class='icon-pencil icon-white'></i> Edit </button>";

            $finalquery=str_replace(" ","~",$tempsql);

            if ($rc) $json .= ',';

            $json .= '{';

            $json .= '"id":"'.$row->id.'","';

            $json .= 'cell":["'.$counter123.'","'.addslashes(str_replace("'","`",$row->order_no)).'","'.addslashes(str_replace("'","`",$row->sname)).'","'.addslashes(str_replace("'","`",$row->name)).'"';

            $json .= ',"'.$status.'","'.$chng.'","'.$edit.'"]';


            $json .= "}";

            $rc = true;


            $counter123++;

        }

        $json .= "]";

        $json .= "}";

        return $json;

    }

    function gettable_states($db=array())
    {
        $table = "states s";
        $page = $db['page'];

        $rp = $db['rp'];

        $sortname = $db['sortname'];

        $sortorder = $db['sortorder'];






        if($sortname == "" || $sortorder == ""){
            $sort = "";
        }else{
        $sort = "ORDER BY $sortname $sortorder";
        }


        if (!$page) $page = 1;

        if (!$rp) $rp = 10;



        $start = (($page-1) * $rp);



        $limit = "LIMIT $start, $rp";



        $sql = "SELECT s.*,s.name as sname FROM  $table $sort $limit";

        $result = $this->db->query($sql);

        $tempsql=" ".$table." ".$sort." ".$limit;



        $total = $this->countRec('s.id',$table,"");



        header("Content-type: application/json");



        $json = '';

        $json .= '{';

        $json .= '"page": '.$page.',';

        $json .= '"total": '.$total.',';

        $json .= '"rows": [';

        $rc = false;

        $counter123=1;



        foreach($result->result() as $row) {



            if($row->status=='0')

            {

                $status="<span class='btn btn-success btn-sm btn-grad'>Active</span>";

                $chng="<button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";

            }

            else

            {

                $status="<span class='btn btn-danger btn-sm btn-grad'>In-Active</span>";

                $chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";

            }

            $edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$row->id.")'><i class='icon-pencil icon-white'></i> Edit </button>";

            $finalquery=str_replace(" ","~",$tempsql);

            if ($rc) $json .= ',';

            $json .= '{';

            $json .= '"id":"'.$row->id.'","';

            $json .= 'cell":["'.$counter123.'","'.addslashes(str_replace("'","`",$row->sname)).'"';

            $json .= ',"'.$status.'","'.$chng.'","'.$edit.'"]';


            $json .= "}";

            $rc = true;


            $counter123++;

        }

        $json .= "]";

        $json .= "}";

        return $json;

    }


    function gettable_clientscategory($db=array())
    {
        $table = "clientscategory s";
        $page = $db['page'];

        $rp = $db['rp'];

        $sortname = $db['sortname'];

        $sortorder = $db['sortorder'];






        if($sortname == "" || $sortorder == ""){
            $sort = "";
        }else{
            $sort = "ORDER BY $sortname $sortorder";
        }


        if (!$page) $page = 1;

        if (!$rp) $rp = 10;



        $start = (($page-1) * $rp);



        $limit = "LIMIT $start, $rp";



        $sql = "SELECT s.*,s.name as sname FROM  $table $sort $limit";

        $result = $this->db->query($sql);

        $tempsql=" ".$table." ".$sort." ".$limit;



        $total = $this->countRec('s.id',$table,"");



        header("Content-type: application/json");



        $json = '';

        $json .= '{';

        $json .= '"page": '.$page.',';

        $json .= '"total": '.$total.',';

        $json .= '"rows": [';

        $rc = false;

        $counter123=1;



        foreach($result->result() as $row) {



            if($row->status=='0')

            {

                $status="<span class='btn btn-success btn-sm btn-grad'>Active</span>";

                $chng="<button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";

            }

            else

            {

                $status="<span class='btn btn-danger btn-sm btn-grad'>In-Active</span>";

                $chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";

            }

            $edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$row->id.")'><i class='icon-pencil icon-white'></i> Edit </button>";

            $finalquery=str_replace(" ","~",$tempsql);

            if ($rc) $json .= ',';

            $json .= '{';

            $json .= '"id":"'.$row->id.'","';

            $json .= 'cell":["'.$counter123.'","'.addslashes(str_replace("'","`",$row->sname)).'"';

            $json .= ',"'.$status.'","'.$chng.'","'.$edit.'"]';


            $json .= "}";

            $rc = true;


            $counter123++;

        }

        $json .= "]";

        $json .= "}";

        return $json;

    }




    function gettable_materials($db=array())
    {
        $table = "materials s";
        $page = $db['page'];

        $rp = $db['rp'];

        $sortname = $db['sortname'];

        $sortorder = $db['sortorder'];






        if($sortname == "" || $sortorder == ""){
            $sort = "";
        }else{
            $sort = "ORDER BY $sortname $sortorder";
        }


        if (!$page) $page = 1;

        if (!$rp) $rp = 10;



        $start = (($page-1) * $rp);



        $limit = "LIMIT $start, $rp";



        $sql = "SELECT s.*,s.name as sname FROM  $table $sort $limit";

        $result = $this->db->query($sql);

        $tempsql=" ".$table." ".$sort." ".$limit;



        $total = $this->countRec('s.id',$table,"");



        header("Content-type: application/json");



        $json = '';

        $json .= '{';

        $json .= '"page": '.$page.',';

        $json .= '"total": '.$total.',';

        $json .= '"rows": [';

        $rc = false;

        $counter123=1;



        foreach($result->result() as $row) {



            if($row->status=='0')

            {

                $status="<span class='btn btn-success btn-sm btn-grad'>Active</span>";

                $chng="<button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";

            }

            else

            {

                $status="<span class='btn btn-danger btn-sm btn-grad'>In-Active</span>";

                $chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";

            }

            $edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$row->id.")'><i class='icon-pencil icon-white'></i> Edit </button>";

            $finalquery=str_replace(" ","~",$tempsql);

            if ($rc) $json .= ',';

            $json .= '{';

            $json .= '"id":"'.$row->id.'","';

            $json .= 'cell":["'.$counter123.'","'.addslashes(str_replace("'","`",$row->order_no)).'","'.addslashes(str_replace("'","`",$row->sname)).'"';

            $json .= ',"'.$status.'","'.$chng.'","'.$edit.'"]';


            $json .= "}";

            $rc = true;


            $counter123++;

        }

        $json .= "]";

        $json .= "}";

        return $json;

    }

    function gettable_colors($db=array())
{
    $table = "colors s";
    $page = $db['page'];

    $rp = $db['rp'];

    $sortname = $db['sortname'];

    $sortorder = $db['sortorder'];






    if($sortname == "" || $sortorder == ""){
        $sort = "";
    }else{
        $sort = "ORDER BY $sortname $sortorder";
    }


    if (!$page) $page = 1;

    if (!$rp) $rp = 10;



    $start = (($page-1) * $rp);



    $limit = "LIMIT $start, $rp";



    $sql = "SELECT s.*,s.name as sname FROM  $table $sort $limit";

    $result = $this->db->query($sql);

    $tempsql=" ".$table." ".$sort." ".$limit;



    $total = $this->countRec('s.id',$table,"");



    header("Content-type: application/json");



    $json = '';

    $json .= '{';

    $json .= '"page": '.$page.',';

    $json .= '"total": '.$total.',';

    $json .= '"rows": [';

    $rc = false;

    $counter123=1;



    foreach($result->result() as $row) {



        if($row->status=='0')

        {

            $status="<span class='btn btn-success btn-sm btn-grad'>Active</span>";

            $chng="<button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";

        }

        else

        {

            $status="<span class='btn btn-danger btn-sm btn-grad'>In-Active</span>";

            $chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";

        }

        $edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$row->id.")'><i class='icon-pencil icon-white'></i> Edit </button>";

        $finalquery=str_replace(" ","~",$tempsql);

        if ($rc) $json .= ',';

        $json .= '{';

        $json .= '"id":"'.$row->id.'","';

        $json .= 'cell":["'.$counter123.'","'.addslashes(str_replace("'","`",$row->order_no)).'","'.addslashes(str_replace("'","`",$row->sname)).'"';

        $json .= ',"'.$status.'","'.$chng.'","'.$edit.'"]';


        $json .= "}";

        $rc = true;


        $counter123++;

    }

    $json .= "]";

    $json .= "}";

    return $json;

}

    function gettable_sizes($db=array())
    {
        $table = "sizes s";
        $page = $db['page'];

        $rp = $db['rp'];

        $sortname = $db['sortname'];

        $sortorder = $db['sortorder'];






        if($sortname == "" || $sortorder == ""){
            $sort = "";
        }else{
            $sort = "ORDER BY $sortname $sortorder";
        }


        if (!$page) $page = 1;

        if (!$rp) $rp = 10;



        $start = (($page-1) * $rp);



        $limit = "LIMIT $start, $rp";



        $sql = "SELECT s.*,s.name as sname FROM  $table $sort $limit";

        $result = $this->db->query($sql);

        $tempsql=" ".$table." ".$sort." ".$limit;



        $total = $this->countRec('s.id',$table,"");



        header("Content-type: application/json");



        $json = '';

        $json .= '{';

        $json .= '"page": '.$page.',';

        $json .= '"total": '.$total.',';

        $json .= '"rows": [';

        $rc = false;

        $counter123=1;



        foreach($result->result() as $row) {



            if($row->status=='0')

            {

                $status="<span class='btn btn-success btn-sm btn-grad'>Active</span>";

                $chng="<button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";

            }

            else

            {

                $status="<span class='btn btn-danger btn-sm btn-grad'>In-Active</span>";

                $chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";

            }

            $edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$row->id.")'><i class='icon-pencil icon-white'></i> Edit </button>";

            $finalquery=str_replace(" ","~",$tempsql);

            if ($rc) $json .= ',';

            $json .= '{';

            $json .= '"id":"'.$row->id.'","';

            $json .= 'cell":["'.$counter123.'","'.addslashes(str_replace("'","`",$row->order_no)).'","'.addslashes(str_replace("'","`",$row->sname)).'"';

            $json .= ',"'.$status.'","'.$chng.'","'.$edit.'"]';


            $json .= "}";

            $rc = true;


            $counter123++;

        }

        $json .= "]";

        $json .= "}";

        return $json;

    }





    function gettable_seater($db=array())
    {
        $table = "seater";
        $page = $db['page'];

        $rp = $db['rp'];

        $sortname = $db['sortname'];

        $sortorder = $db['sortorder'];



        if($db['query']!=''){

            $where = ' WHERE  '.$db['qtype'].' LIKE "%'.$db['query'].'%"';

        } else {

            $where ='  ';

        }

        if($db['letter_pressed']!=''){

            $where = ' WHERE  '.$db['qtype'].' LIKE "'.$db['letter_pressed'].'%"';

        }

        if($db['letter_pressed']=='#'){

            $where = ' WHERE  '.$db['qtype'].' REGEXP "[[:digit:]]" ';

        }


        if($sortname !="" && $sortorder != "")
        $sort = "ORDER BY $sortname $sortorder";
        else{
            $sort = "";
        }

        if (!$page) $page = 1;

        if (!$rp) $rp = 10;

        $start = (($page-1) * $rp);

        $limit = "LIMIT $start, $rp";

        $sql = "SELECT * FROM  $table $where $sort $limit";

        $result = $this->db->query($sql);

        $tempsql=" ".$table." ".$where." ".$sort." ".$limit;

        $total = $this->countRec('id',$table,$where);

        header("Content-type: application/json");

        $json = '';

        $json .= '{';

        $json .= '"page": '.$page.',';

        $json .= '"total": '.$total.',';

        $json .= '"rows": [';

        $rc = false;

        $counter123=1;


        foreach($result->result() as $row) {


            if($row->status=='0')
            {

                $status="<span class='btn btn-success btn-sm btn-grad'>Active</span>";

                $chng="<button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";

            }
            else
            {

                $status="<span class='btn btn-danger btn-sm btn-grad'>In-Active</span>";

                $chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";

            }

            $edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$row->id.")'><i class='icon-pencil icon-white'></i> Edit </button>";
            $image="<img src='".str_replace('/artii_manage','',base_url())."".$row->img1."' >";
            $image1="<img src='".str_replace('/artii_manage','',base_url())."".$row->img2."'>";

            $finalquery=str_replace(" ","~",$tempsql);

            if ($rc) $json .= ',';

            $json .= '{';

            $json .= '"id":"'.$row->id.'","';

            $json .= 'cell":["'.$counter123.'","'.addslashes(str_replace("'","`",$row->name)).'","'.$image.'","'.$image1.'"';

            $json .= ',"'.$status.'","'.$chng.'&nbsp;'.$edit.'"]';


            $json .= "}";

            $rc = true;


            $counter123++;

        }

        $json .= "]";

        $json .= "}";

        return $json;

    }


    function gettable_subcategory($db=array())
    {

        $sortname = "";

        $sortorder ="";
        $table = "subcategory s,category c";
        $page = $db['page'];

        $rp = $db['rp'];

        $sortname = $db['sortname'];

        $sortorder = $db['sortorder'];



        if($db['query']!=''){

            $where = ' WHERE  s.category_id=c.id and '.$db['qtype'].' LIKE "%'.$db['query'].'%"';

        } else {

            $where =' where s.category_id=c.id ';

        }

        if($db['letter_pressed']!=''){

            $where = ' WHERE  s.category_id=c.id and '.$db['qtype'].' LIKE "'.$db['letter_pressed'].'%"';

        }

        if($db['letter_pressed']=='#'){

            $where = ' WHERE s.category_id=c.id and '.$db['qtype'].' REGEXP "[[:digit:]]" ';

        }

        if(isset($sortname) && isset($sortorder))
            $sort = "ORDER BY $sortname $sortorder";
        else
            $sort = "";



        if (!$page) $page = 1;

        if (!$rp) $rp = 10;



        $start = (($page-1) * $rp);



        $limit = "LIMIT $start, $rp";



        $sql = "SELECT s.*,s.name as sname,c.name as cname FROM  $table $where $sort $limit";

        $result = $this->db->query($sql);

        $tempsql=" ".$table." ".$where." ".$sort." ".$limit;



        $total = $this->countRec('s.id',$table,$where);



        header("Content-type: application/json");



        $json = '';

        $json .= '{';

        $json .= '"page": '.$page.',';

        $json .= '"total": '.$total.',';

        $json .= '"rows": [';

        $rc = false;

        $counter123=1;



        foreach($result->result() as $row) {



            if($row->status=='0')

            {

                $status="<span class='btn btn-success btn-sm btn-grad'>Active</span>";

                $chng="<button class='btn btn-danger btn-sm btn-grad' onclick='changestatus(1,".$row->id.")'><i class='icon-remove'></i> Deactivate </button>";

            }

            else

            {

                $status="<span class='btn btn-danger btn-sm btn-grad'>In-Active</span>";

                $chng="<button class='btn btn-success btn-sm btn-grad' onclick='changestatus(0,".$row->id.")'><i class='icon-ok'></i> Activate </button>";

            }

            $edit="<button class='btn btn-info btn-sm btn-grad' onclick='edit(".$row->id.")'><i class='icon-pencil icon-white'></i> Edit </button>";

            $finalquery=str_replace(" ","~",$tempsql);

            if ($rc) $json .= ',';

            $json .= '{';

            $json .= '"id":"'.$row->id.'","';

            $json .= 'cell":["'.$counter123.'","'.addslashes(str_replace("'","`",$row->order_no)).'","'.addslashes(str_replace("'","`",$row->cname)).'","'.addslashes(str_replace("'","`",$row->sname)).'"';

            $json .= ',"'.$status.'","'.$chng.'","'.$edit.'"]';


            $json .= "}";

            $rc = true;


            $counter123++;

        }

        $json .= "]";

        $json .= "}";

        return $json;

    }


    function getgiftproducts($id){

        $sql = "select * from products where id in(select pid from gift_products where gift_id = {$id})";
        $result = $this->db->query($sql);
        return $result->result();
    }

    function generatecode($shortform, $categ){
    	$len = strlen($shortform);
    	$sql = "SELECT CONCAT(  '$shortform', INSERT( LPAD( count(id)+1, 3,  '0' ) , 0, $len,  '$shortform' ) ) AS OrderNo FROM products where cat_id=$categ ";
    	$q=$this->db->query($sql);
    	if($q->num_rows()>0){
    		$res = $q->result();
    		return $res[0]->OrderNo;
    	}
    	else
    		return $shortform.'001';
    }
    
    function updatecode($shortform, $categ){
    	$len = strlen($shortform);
    	$sql = "select id from products where cat_id=$categ order by id asc";
    	$q=$this->db->query($sql);$i =1;
    	if($q->num_rows()>0){
    		$res = $q->result();
    		foreach ($res as $r){
    			$str = str_pad($i,3,"0",STR_PAD_LEFT);
    			$sql = "update products set pcode='".$shortform.$str."' where id=".$r->id." ";
    			$q=$this->db->query($sql);
    			$i = $i+1;
    		}
    	}
    }
    

}

?>