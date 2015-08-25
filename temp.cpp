#include <iostream>
#include <fstream>
#include <vector>
#include <math.h>
using namespace std;
int main(int argc, char *argv[]) {
    ifstream stream(argv[1]);
    std::vector<int> nums;
    string line;
    for(int i=0; i<1000; i++){
    	nums.push_back(pow(i, 2));
    }
    while (getline(stream, line)) {
    	cout << line << endl;
    }
    return 0;
}