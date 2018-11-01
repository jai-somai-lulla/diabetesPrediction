import unittest
import csv
from selenium import webdriver
from selenium.common.exceptions import NoSuchElementException
import mysql.connector
import time 
class Browse(unittest.TestCase):
    def setUp(self):  
        self.count=0;
        self.path="./ScreenShots/Screen_shot"
        self.type=".png"

        self.driver = webdriver.Firefox()
        self.driver.set_page_load_timeout(30)
        self.driver.get("http://localhost/My_web/dmw/")


        self.driver.implicitly_wait(5)
# take screen_shot
        ans = self.path + repr(self.count)
        ans += self.type
        self.driver.get_screenshot_as_file(ans)
        self.count += 1


    def test_browse(self):
    
      filename = 'test.csv'
      line_number = 1
      
      mydb = mysql.connector.connect(
        host="localhost",
        user="stark",
        passwd="iron",
        database="diabetes" 
        )
        
      for line_number in range(2):  
        #with open(filename, 'rb') as f:
        with open(filename) as f:
            mycsv = csv.reader(f)
            mycsv = list(mycsv)
            p=mycsv[line_number+1][0]
            g=mycsv[line_number+1][1]
            b=mycsv[line_number+1][2]
            s=mycsv[line_number+1][3]
            i=mycsv[line_number+1][4]
            bb=mycsv[line_number+1][5]
            d=mycsv[line_number+1][6]
            a=mycsv[line_number+1][7]
            outcome=mycsv[line_number+1][8]
        type=self.type
        count=self.count
        path=self.path
        driver = self.driver       
        
        
        
        
        myb = mydb.cursor()     
        myb.execute("select count(*) from records")  
        print("Before Submit")
        dbrowbefore= myb.fetchone()[0]
        print(dbrowbefore)

        
        
        Pregnancies = driver.find_element_by_name("Pregnancies")
        Pregnancies.clear()
        Pregnancies.send_keys(p)

        Glucose = driver.find_element_by_name("Glucose")
        Glucose.clear()
        Glucose.send_keys(g)

    

        BloodPressure = driver.find_element_by_name("BloodPressure")
        BloodPressure.clear()
        BloodPressure.send_keys(b)

        SkinThickness = driver.find_element_by_name("SkinThickness")
        SkinThickness.clear()
        SkinThickness.send_keys(s)
        
        Insulin = driver.find_element_by_name("Insulin")
        Insulin.clear()
        Insulin.send_keys(i)


        BMI = driver.find_element_by_name("BMI")
        BMI.clear()
        BMI.send_keys(bb)


        DiabetesPedigreeFunction = driver.find_element_by_name("DiabetesPedigreeFunction")
        DiabetesPedigreeFunction.clear()
        DiabetesPedigreeFunction.send_keys(d)

        Age = driver.find_element_by_name("Age")
        Age.clear()
        Age.send_keys(a)

        driver.implicitly_wait(10)
# Click() for submitting the form
        ans = path + repr(count) + repr(line_number)
        ans += type
        driver.get_screenshot_as_file(ans)
        count += 1
 
          
        
        subber = driver.find_element_by_name('submit')
        subber.click()
        ans = path + repr(count)
        ans += type
        driver.get_screenshot_as_file(ans)
        count += 1
        ele=driver.find_element_by_id("outcome")
        ans=ele.get_attribute("value")
     
     
        time.sleep(2)
        
        mycursor = mydb.cursor()     
        mycursor.execute("select count(*) from records")  
        print("After Submit")
        dbrowafter= mycursor.fetchone()[0]
        print(dbrowafter)
        
        with self.subTest(i=line_number):    
          self.assertEqual(dbrowafter,(dbrowbefore))
          

        #with self.subTest(i=line_number):    
         #   self.assertEqual(ans,outcome)
            
        #try:
            #with self.subTest(i=line_number):    
             #   self.assertEqual(driver.find_element_by_id("positive").size(),outcome)            
        #except NoSuchElementException:
         #   self.assertEqual(0,outcome)
            #self.assertEqual(0,outcome)    
                
            
        #driver.implicitly_wait(10)
        

    def tearDown(self):
        self.driver.quit()
    #self.assertEqual([], self.verificationErrors)


unittest.main() 
