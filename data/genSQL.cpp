#include <iostream>
#include <fstream>
#include <vector>
#include <random>
#include <string>
#include<time.h> 
using namespace std;



struct User
{
    string username;
    string password;
    string email;
    string permissionType;
};

struct Uni
{
    string name;
    string domain;
};

struct Subject
{
    string code;
    int  i_id;
};

struct Session
{
    string coordinator_id;
    string subject_code;
    string session_expiry;
    int i_id;
    
};
 

 struct Staff
 {
    string username;
    int  s_id;   
 };



vector<User> users;
vector<Uni> unis;
vector<Subject> subjects;
vector <Session> sessions;
vector<Staff> tutors;




void readUser(ifstream& fin)
{
    fin.open("User.txt");
    if(!fin.good())
    {
        cout<<"Users failed to open"<<endl;
    }

    while(fin.good())
    {
        User s;
        
        fin >> s.username >> s.password >> s.email >> s.permissionType;
        users.push_back(s);
    
    }
    fin.close();
}

void readUni(ifstream& fin)
{
    string temp;
    fin.open("uni.txt");
    if(!fin.good())
    {
        cout<<"uni failed to open"<<endl;
    }

    int i = 0;
    Uni u;
    while(fin.good())
    {
      

        if(i % 2 == 0)
        {
            getline(fin,u.name);
        }
        else if (i % 2 == 1)
        {
            getline(fin,u.domain);
            unis.push_back(u);
        }
        i++;
    }

    fin.close();
}


void genSubject(ifstream& fin)
{
    Subject sub;
    string prefixs[] = {"CSIT","CSCI","MEDI","COMM"};\
    string prefix;
    int suffix;

    int prefSize = sizeof(prefixs)/sizeof(prefixs[0]);
 

    for (size_t i = 0; i < 30; i++)
    {
        
        prefix = prefixs[rand() % prefSize];
        suffix = (rand()) % (999-101) + 100;
        sub.code =  prefix + to_string(suffix);
        sub.i_id =  rand() % (unis.size() - 1) + 1;
        subjects.push_back(sub);
    }
}


void genSession(ifstream& fin)
{
    vector <string> cUsers;
    int randUser;
    for(User u: users)
    {
        if(u.permissionType == "coordinator")
        {
       
            cUsers.push_back(u.username);
        }
    }

    Session s;
    for (size_t i = 0; i < subjects.size(); i++)
    {
        randUser = rand() % subjects.size(); 
       
        s.coordinator_id = cUsers[randUser];
        s.subject_code = subjects[i].code;
        s.i_id  = subjects[i].i_id;
        s.session_expiry = "2019-08-14";

        sessions.push_back(s);

    }
}

void genStaff()
{

    int randUser, randSubj;

    Staff s;
    for (size_t i = 0; i < subjects.size(); i++)
    {
        randUser = rand() % users.size();
        randSubj = rand() % subjects.size();
        s.username = users[randUser].username;
        s.s_id = randSubj;

        tutors.push_back(s);

    }
     

}

void genSQL()
{
    ofstream fout;

    fout.open("data.sql");

    for(Uni u: unis)
    {
        fout << "INSERT INTO institution (name,domain) VALUES (\"" << u.name << "\",\"" << u.domain << "\");" <<endl;
    }


    for(User u: users)
    {
        fout << "INSERT INTO user (username,password,email,permission_type )VALUES (\"" << u.username << "\",\"" << u.password << "\", \""<<u.email<<"\",\""<<u.permissionType<<"\");" <<endl;
    }

    for(Subject s: subjects)
    {
        fout << "INSERT INTO subject VALUES (\"" << s.code << "\" , "<< s.i_id << " );"<<endl;
    }


    for(Session s: sessions)
    {
        fout << "INSERT INTO subject_session(isActive, coordinator_id,  session_expiry, subject_code, i_id) VALUES (true , \""
        << s.coordinator_id   << "\" , DATE(\""<< s.session_expiry <<"\") , \""<< s.subject_code <<"\" , "<< s.i_id << ");" << endl;
    }


    for(Staff s: tutors)
    {
        fout << "INSERT INTO staff_allocation   VALUES( \"" << s.username << "\", "<< s.s_id << ");"<<endl;
    }

    fout.close();
}

int main()
{

    ifstream fin;
    srand(time(0));
    readUser(fin);
    readUni(fin);
    genSubject(fin);
    genSession(fin);
    genStaff();
    genSQL();

    return 0;
}
